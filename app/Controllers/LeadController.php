<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LeadMaster;
use App\Models\Note;
use App\Models\Remainder;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Campaign;
use App\Models\Order;
use App\Models\Lead;
use \Hermawan\DataTables\DataTable;



class LeadController extends BaseController
{

    protected $campaign_model;
    protected $order_model;
    protected $lead_model;
    protected $lead_master_model;

    protected $note_model;

    protected $remainder_model;


    protected $session;





    public function __construct()
    {

        $this->campaign_model = new Campaign;
        $this->order_model = new Order;
        $this->lead_model = new Lead;
        $this->lead_master_model = new LeadMaster;
        $this->note_model = new Note;
        $this->remainder_model = new Remainder;

        $this->session = session();


    }

    public function index()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Leads']),
            'page_title' => view('partials/page-title', ['title' => 'All Leads', 'pagetitle' => 'TTMG']),
        ];
        $orders = $this->order_model->select('pkorderid,agent')->where("status !=", 0)->where("status !=", 3)->findAll();
        $client = get_client();
        $data['order'] = $orders;
        $data['client'] = $client;

        return view('leads_management/index', $data);
    }

    public function add_lead($id = "")
    {
        if ($this->request->getMethod() === 'post') {

        } elseif ($id != "") {

            $lead = $this->lead_model->find($id);
            $order = $this->order_model->find($lead['order_id']);
            $camp_name = $this->campaign_model->select('id,campaign_name')->find($order['categoryname']);


            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Edit Lead']),
                'page_title' => view('partials/page-title', ['title' => 'Edit Lead', 'pagetitle' => 'TTMG']),
            ];

            $data['lead'] = $lead;
            $data['camp_id'] = $order['categoryname'];
            $data['camp_name'] = $camp_name;
        } else {

            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Add New Lead']),
                'page_title' => view('partials/page-title', ['title' => 'Add New Lead', 'pagetitle' => 'TTMG']),
            ];
            $data['campaigns'] = $this->campaign_model
                ->select('id,campaign_name') // Specify the columns you want
                ->orderBy('id', 'DESC')
                ->findAll();
            return view('leads_management/add_lead', $data);
        }
        $data['campaigns'] = $this->campaign_model
            ->select('id,campaign_name') // Specify the columns you want
            ->orderBy('id', 'DESC')
            ->findAll();
        return view('leads_management/add_lead', $data);
    }

    public function ajax_Datatable_leads($id = "")
    {
        $db = db_connect();

        $builder = $db->table('ttmg_leads_master')->select('id,agent_name,firstname,lastname,state,phone_number,reject_reason,id as option_id,id as lead_id,status,order_id');
        if ($id != 0) {
            $builder->where('order_id', $id);
        }
        if (is_vendor()) {
            $builder->where('vendor_id', get_user_id());
        } else if (is_client()) {
            $builder->where('client_id', get_user_id());
        }

        $data = DataTable::of($builder)
            ->edit('lead_id', function ($row) {
                return '<a href="' . site_url('add-lead/') . $row->id . '" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                    <a href="' . base_url('lead-delete/') . $row->id . '" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                    <a href="' . site_url('replace-lead/') . $row->id . '" class="px-3 text-success"><i class="uil uil-refresh font-size-18"></i></a>';
            })


            ->edit('option_id', function ($row) {
                if ($row->status == 3) {
                    return '<button class="btn btn-success px-3" onclick="acceptLead(' . $row->id . ')">Accept</button>'
                        . '<button class="btn btn-danger px-3 mx-2" onclick="rejectLead(' . $row->id . ')">Reject</button>';
                } else if ($row->status == 2) {
                    return '<span class="badge bg-danger">Rejected</span>';
                } else if ($row->status == 1) {
                    return '<span class="badge bg-success">Approved</span>';
                }

            })->add('CHe', function ($row) {
                return '<input class="form-check-input lead-check" name="checkbox" type="checkbox" id="formCheck2">';
            }, 'last')->hide('status')->hide('order_id')
            ->filter(function ($builder, $request) {

                if ($request->state) {
                    $builder->where('state', $request->state);
                }
                if ($request->lead_status == 'all') {
                    $builder->where('order_id !=', 0);
                }
                if ($request->lead_status == 'un') {
                    $builder->where('order_id', 0);
                }
                if ($request->client) {
                    $builder->where('client_id', $request->client);
                }


            })

            ->toJson();


        return $data;

    }
    public function get_lead_detail($id)
    {
        $this->lead_model->select('complete_lead,status,reject_reason');
        $lead = $this->lead_model->where('id', $id)->findAll();
        $complete_lead = json_decode($lead[0]['complete_lead']);
        $html = '<table class="table table-bordered">';

        foreach ($complete_lead as $key => $cp) {
            $html .= '<tr><td style="  font-weight: bold;">' . ucfirst(str_replace('_', ' ', $key)) . '</td><td>' . $cp . '</td></tr>';
        }
        if ($lead[0]['status'] == 1) {
            $html .= '<tr><td style="  font-weight: bold;">Status</td><td><span class="badge bg-success"> Approved </span></td></tr>';
        } else if ($lead[0]['status'] == 2) {
            $html .= '<tr><td style="  font-weight: bold;">Status</td><td><span class="badge bg-danger"> Rejected </span></td></tr>';
        }
        if ($lead[0]['status'] == 2 && $lead[0]['reject_reason'] != "") {
            $html .= '<tr><td style="  font-weight: bold;">Rejection Reason </td><td>' . $lead[0]['reject_reason'] . ' </td></tr>';
        }
        $html .= '</table>';
        echo $html;
    }

    public function reject_lead()
    {
        $id = $this->request->getPost('l_id');
        $reason = $this->request->getPost('reason');
        $this->lead_model->update($id, ['reject_reason' => trim($reason), 'status' => 2]);
        log_activity("Lead Rejected Id : " . $id, get_user_fullname());
        $notification_data = [
            'description' => 'Lead Rejected ID : ' . $id,
            'to_user_id' => 1,
            'link' => base_url() . "lead-index/"
        ];

        add_notification($notification_data);
        echo json_encode($id);
    }
    public function accept_lead()
    {
        $id = $this->request->getPost('id');
        $response = $this->lead_model->update($id, ['status' => 1]);

        $notification_data = [
            'description' => 'Lead Accept ID : ' . $id,
            'to_user_id' => 1,
            'link' => base_url() . "lead-index/"
        ];
        log_activity("Lead Accepted Id : " . $id, get_user_fullname());

        add_notification($notification_data);
        echo json_encode($response);
    }

    public function save_notes()
    {
        $session = session();
        $post = $this->request->getPost('post');
        $id = $this->request->getPost('id');

        $post_data = [
            "lead_id" => $id,
            "client_id" => $session->get('login_id'),
            "note_text" => $post,
            "created_at" => date("Y-m-d h:i:sa")
        ];

        $response = $this->note_model->insert($post_data);

        json_encode($response);
    }

    public function get_notes($id)
    {
        $user_id = $this->session->get('login_id');

        $result = $this->note_model
            ->where('lead_id', $id)
            ->where('client_id', $user_id)
            ->findAll();
        echo json_encode($result);
    }

    public function getLeadFormDataByCampId()
    {
        $camp_id = $this->request->getGet('camp_id');
        $camp = $this->campaign_model->select('id,campaign_name,campaign_columns')->find($camp_id);
        echo json_encode($camp);
    }

    public function save_remainder()
    {
        $session = session();
        $title = $this->request->getPost('title');
        $post = $this->request->getPost('post');
        $id = $this->request->getPost('id');
        $datetime = $this->request->getPost('datetime');
        $datetime = date('Y-m-d H:i:s', strtotime($datetime));

        $post_data = [
            "lead_id" => $id,
            "client_id" => $session->get('login_id'),
            "remainder_title" => $title,
            "remainder_text" => $post,
            "remainder_time_date" => $datetime,
            "created_at" => date("Y-m-d h:i:sa")
        ];
        $response = $this->remainder_model->insert($post_data);

        json_encode($response);
    }

    public function get_remainder($id)
    {
        $user_id = $this->session->get('login_id');

        $result = $this->remainder_model
            ->where('lead_id', $id)
            ->where('client_id', $user_id)
            ->findAll();
        echo json_encode($result);
    }


    public function remainder_cronjob()
    {
        $remainders = $this->remainder_model->where('remainder_time_date =', date('Y-m-d H:i:s'))->where('flag !=', 1)->findAll();
        if ($remainders) {
            foreach ($remainders as $r) {

                $notification_data = [
                    'description' => 'Remainder for : ' . $r['$remainder_title'],
                    'to_user_id' => $r['client_id'],
                    'link' => base_url() . "lead-index/"
                ];
                $this->remainder_model->update($r['client_id'], ["flag" => 1]);
                add_notification($notification_data);
            }
        }
    }

    public function sync_lead_api()
    {

        $token = $this->request->getServer('HTTP_AUTHORIZATION');

        if ($token == 'Bearer ' . get_option("token")) {
            $apiResponseString = $this->request->getPost();
            $apiResponseJson = $apiResponseString;
            $leads = $apiResponseJson['leads'];
            $camp = $this->campaign_model->find($apiResponseJson['category_id']);
            $crm_camp_col = json_decode($camp['campaign_columns'], true);

            $batch_leads = [];
            foreach ($leads as $lead) {
                $post_data = [];
                $complete_lead = array_merge(...json_decode($lead['complete_lead'], 1));
                foreach ($crm_camp_col as $col) {
                    foreach ($complete_lead as $key => $cl) {
                        if ($col['col_slug'] == $key) {
                            $post_data[$key] = $cl;
                        }
                    }
                }
                $lead_data = [
                    "phone_number" => isset($post_data['phone_number']) ? $post_data['phone_number'] : "",
                    "agent_name" => isset($post_data['agent_name']) ? $post_data['agent_name'] : "",
                    "firstname" => isset($post_data['first_name']) ? $post_data['first_name'] : "",
                    "lastname" => isset($post_data['last_name']) ? $post_data['last_name'] : "",
                    "state" => isset($post_data['state']) ? $post_data['state'] : "",
                    "complete_lead" => json_encode($post_data),
                    "order_id" => "",
                    "status" => 3,
                    "camp_id" => $apiResponseJson['category_id'],
                    "vendor_id" => "",
                    "client_id" => "",
                    "master_search" => json_encode($post_data),
                ];
                array_push($batch_leads, $lead_data);
            }

            $response = $this->lead_master_model->insertBatch($batch_leads);
            echo json_encode($response);

        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }

    }

    public function assign_lead()
    {
        $leadIds = $this->request->getPost('leadId');
        $orderId = $this->request->getPost('order_id');
        $order=$this->order_model->find($orderId);
        $leadIds=explode(",",$leadIds);
        $order= $this->order_model->find($orderId);
        $leads_to_assign=[];
        foreach ($leadIds as $id) {
            $lead=$this->lead_master_model->find($id);
            $assigned_lead=$this->lead_model->where('phone_number',$lead['phone_number'])->where('client_id',$order['fkclientid'])->where('camp_id',$order['categoryname'])->get()->getResult();
           
            if(count($assigned_lead)>0 || $order['remainingLeads']==0){
                if($order['remainingLeads']==0){
                    $lead['duplicate']="3";
                }else{
                    $lead['duplicate']="1";
                }
            array_push($leads_to_assign,$lead);
            }
            else{
                $lead['order_id']=$orderId;
                $lead['client_id']=$order['fkclientid'];
                $lead['vendor_id']=$order['fkvendorstaffid'];
                unset($lead['rejected_lead']);
                $id=$this->lead_model->insert($lead);
                $this->order_model->update_order(1, $orderId);
                $lead['duplicate']=0;
                array_push($leads_to_assign,$lead);
            }
        }

        
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Assigned Leads']),
            'page_title' => view('partials/page-title', ['title' => 'Assigned Leads', 'pagetitle' => 'TTMG']),
        ];
        $data['leads']=$leads_to_assign;

        return view('leads_management/assigned_leads',$data);
    }

    public function test_mail(){
        
        // $response =send_email("tshoaib10@gmail.com","Add Lead");

        return 0;
    }
}
