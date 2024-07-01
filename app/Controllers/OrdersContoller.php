<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\Leads_master;
use App\Models\LeadMaster;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Campaign;
use App\Models\Order;
use App\Models\Lead;
use App\Models\Auth as Auth_Model;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\IOFactory;




use \Hermawan\DataTables\DataTable;
use App\Libraries\Csvimport;




class OrdersContoller extends BaseController
{
    use ResponseTrait;

    protected $campaign_model;
    protected $order_model;
    protected $lead_model;
    protected $lead_master_model;

    protected $auth_model;



    public function __construct()
    {

        $this->campaign_model = new Campaign;
        $this->order_model = new Order;
        $this->lead_model = new Lead;
        $this->lead_master_model = new LeadMaster;
        $this->auth_model = new Auth_Model;
    }

    public function index($vend_id = "")
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Orders']),
            'page_title' => view('partials/page-title', ['title' => 'All Orders', 'pagetitle' => 'Look For Leads']),
        ];
        $data['campaigns'] = $this->campaign_model->select('id,campaign_name')->findAll();
        $data['vendors'] = $this->auth_model->select('id,firstname,lastname')->where('userrole', 2)->findAll();
        return view('orders_management/index', $data);
    }
    public function sub_vendor_index($sub_ven = "", $sv_id)
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Orders']),
            'page_title' => view('partials/page-title', ['title' => 'All Orders', 'pagetitle' => 'Look For Leads']),
        ];
        $data['sv_id'] = $sv_id;
        return view('orders_management/sub_vendor_index', $data);
    }
    public function ajax_sv_datatables_orders($id = "")
    {
        $db = db_connect();
        $builder = $db->table('ttmg_orders')->select('agent, pkorderid as id ,lead_requested,remainingLeads,fkvendorstaffid,notes,status,pkorderid,fkclientid');

        if ($id != 0) {
            $builder->where('fkvendorstaffid', $id);
        }

        // if (is_vendor()) {
        //     $builder->where('fkvendorstaffid', get_user_id());
        // } elseif (is_client()) {
        //     $builder->where('fkclientid', get_user_id());
        // }
        $data = DataTable::of($builder)->edit('agent', function ($row) {
            return '<a href="' . site_url('order-detail/') . $row->pkorderid . '" class="px-3 text-primary">' . $row->agent . '</a>';
        })->edit('pkorderid', function ($row) {
            $btn = '<a href="' . site_url('create-order/') . $row->pkorderid . '" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>';
            if (is_admin()) {
                if ($row->status == 0) {
                    $btn .= '<a href="#" onclick="unblockOrder(' . $row->pkorderid . ')" class="px-3 text-danger"><i class="fas fa-lock font-size-18"></i></a>';
                } else {
                    $btn .= '<a href="#" onclick="blockOrder(' . $row->pkorderid . ')" class="px-3 text-success"><i class="fas fa-lock-open font-size-18"></i></a>';
                }
                return $btn;
            }
        })->edit('fkvendorstaffid', function ($row) {
            $vendor = get_vendors($row->fkvendorstaffid);
            return $vendor[0]['firstname'] . ' ' . $vendor[0]['lastname'];
        })->edit('status', function ($row) {
            $status = '';
            if ($row->status == 0) {
                $status = '<span class="badge bg-danger">Blocked</span>';
            } else if ($row->status == 1) {
                $status = '<span class="badge bg-primary">Active</span>';
            } else if ($row->status = 3) {
                $status = '<span class="badge bg-success">Completed</span>';
            }
            return $status;
        })
            ->edit('id', function ($row) {
                if (is_admin() && $row->status != 0 && $row->status != 3) {
                    return '<button class="btn btn-primary px-3" onclick="addLeadToOrder(' . $row->pkorderid . ')">Add Lead to Order</button>'
                        . '<button class="btn btn-secondary px-3 mx-2" onclick="importLeads(' . $row->pkorderid . ')">Import Leads</button>';
                } else {
                    return "N/A";
                }
            })
            ->addNumbering()
            ->toJson();
        return $data;
    }
    public function ajax_Datatable_orders($id = "")
    {
        $db = db_connect();
        $builder = $db->table('ttmg_orders')->select('agent, pkorderid as id ,lead_requested,remainingLeads,fkvendorstaffid,notes,status,pkorderid,fkclientid');

        if ($id != 0) {
            $builder->where('categoryname', $id);
        }
    
        if (is_vendor()) {
            $builder->where('fkvendorstaffid', get_user_id());
        } elseif (is_client()) {
            $builder->where('fkclientid', get_user_id());
        }
        $data = DataTable::of($builder)->edit('agent', function ($row) {
            return '<a href="' . site_url('order-detail/') . $row->pkorderid . '" class="px-3 text-primary">' . $row->agent . '</a>';
        })->edit('pkorderid', function ($row) {
            $btn = '<a href="' . site_url('create-order/') . $row->pkorderid . '" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>';
            if (is_admin()) {
                if ($row->status == 0) {
                    $btn .= '<a href="#" onclick="unblockOrder(' . $row->pkorderid . ')" class="px-3 text-danger"><i class="fas fa-lock font-size-18"></i></a>';
                } else {
                    $btn .= '<a href="#" onclick="blockOrder(' . $row->pkorderid . ')" class="px-3 text-success"><i class="fas fa-lock-open font-size-18"></i></a>';
                }
                return $btn;
            }
        })->edit('fkvendorstaffid', function ($row) {
            $vendor = get_vendors($row->fkvendorstaffid);
            return $vendor[0]['firstname'] . ' ' . $vendor[0]['lastname'];
        })->edit('status', function ($row) {
            $status = '';
            if ($row->status == 0) {
                $status = '<span class="badge bg-danger">Blocked</span>';
            } else if ($row->status == 1) {
                $status = '<span class="badge bg-primary">Active</span>';
            } else if ($row->status == 3) {
                $status = '<span class="badge bg-success">Completed</span>';
            }
            return $status;
        })
        ->edit('id', function ($row) {
            if (is_admin() && $row->status != 0 && $row->status != 3) {
                return '<div class="d-flex flex-row">
                            <button class="btn btn-primary m-1" onclick="addLeadToOrder(' . $row->pkorderid . ')">Add Lead to Order</button>
                            <button class="btn btn-secondary m-1" onclick="importLeads(' . $row->pkorderid . ')">Import Leads</button>
                        </div>';
            } else {
                return "N/A";
            }
        })
            ->filter(function ($builder, $request) {
    
                if ($request->order_status == "0") {// blocked orders
                    $builder->where('status', 0);
                }
                if ($request->order_status == '1') {// active/open/orders
                    $builder->where('status', 1);
                }
                if ($request->order_status == '3') {// complete_orders
                    $builder->where('status', 3);
                }
                if ($request->order_status == '4') {// All Orders
                }
    
                if ($request->filter_campaign) {
                    $builder->where('categoryname', $request->filter_campaign);
                }
                if ($request->filter_vendor) {
                    $builder->where('fkvendorstaffid', $request->filter_vendor);
                }
            })->addNumbering()
            ->toJson();
        return $data;
    }
    
    public function create($id = "")
    {

        if ($this->request->getMethod() === 'post') {

            $data = [
                'agent' => $this->request->getPost('agent'),
                'categoryname' => $this->request->getPost('categoryname'),
                'state' => $this->request->getPost('state'),
                'fkvendorstaffid' => $this->request->getPost('fkvendorstaffid'),
                'fkclientid' => $this->request->getPost('fkclientid'),
                'prioritylevel' => $this->request->getPost('prioritylevel'),
                'ageranges' => $this->request->getPost('ageranges'),
                'lead_requested' => $this->request->getPost('lead_requested'),
                'remainingLeads' => $this->request->getPost('lead_requested'),
                // 'fblink' => $this->request->getPost('fblink'),
                'notes' => $this->request->getPost('notes'),
                'orderdate' => $this->request->getPost('orderdate'),
                'status' => "1"
            ];
            $insert_id = $this->order_model->insert($data);
            $notification_data = [
                'description' => 'New Order Has Been Created',
                'to_user_id' => $data['fkclientid'],
                'link' => base_url() . "order-detail/" . $insert_id,
            ];
            add_notification($notification_data);
            if (!is_vendor()) {
                send_email(get_email_by_user_id($data['fkvendorstaffid']), "Add Order");
            }
            if($this->request->getPost('fkclientid')!=0 ){
                send_email(get_email_by_user_id($data['fkclientid']), "Add Order");
            }

            $notification_data = [
                'description' => 'New Order Has Been Created',
                'to_user_id' => $data['fkvendorstaffid'],
                'link' => base_url() . "order-detail/" . $insert_id,
            ];
            add_notification($notification_data);
            log_activity("Order Added Id : " . $insert_id, get_user_fullname());

            session()->setFlashdata('success', 'Order Created Successful!');
            return redirect()->to('order-index');
        } elseif ($id != "") {
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Edit Order']),
                'page_title' => view('partials/page-title', ['title' => 'Edit Order', 'pagetitle' => 'Look For Leads']),
            ];

            $data['order'] = $this->order_model->find($id);

            $data['campaigns'] = $this->campaign_model
                ->select('id,campaign_name') // Specify the columns you want
                ->orderBy('id', 'DESC')
                ->findAll();

            if (is_vendor()) {
                $data['vendors'] = get_vendors(get_user_id());
                $data['clients'] = get_client($id = "", get_user_id());
            } elseif (is_admin()) {
                $data['vendors'] = get_vendors();
                $data['clients'] = get_client();
            }
        } else {
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'New Order']),
                'page_title' => view('partials/page-title', ['title' => 'New Order', 'pagetitle' => 'Look For Leads']),
            ];

            $data['campaigns'] = $this->campaign_model
                ->select('id,campaign_name') // Specify the columns you want
                ->orderBy('id', 'DESC')
                ->findAll();

            if (is_vendor()) {
                $data['vendors'] = get_vendors(get_user_id());
                $data['clients'] = get_client($id = "", get_user_id());
            } elseif (is_admin()) {
                $data['vendors'] = get_vendors();
                $data['clients'] = get_client();
            }


            return view('orders_management/add_order', $data);
        }
        return view('orders_management/add_order', $data);
    }
    public function getLeadFormData()
    {
        $orderId = $this->request->getGet('orderId');
        $camp_id = $this->order_model->select('categoryname')->find($orderId);
        $camp = $this->campaign_model->select('id,campaign_name,campaign_columns')->find($camp_id['categoryname']);
        echo json_encode($camp);
    }

    public function get_orders_api()
    {
        helper('text');
        $order = $this->order_model->select('id,agent_name')->findAll();
        $token = random_string('alnum', '40');
        update_option("token", $token);
        $data = array(

            "camp" => $order,
            'token' => $token

        );
        echo json_encode($data);
    }


    public function lead_add()
    {

        $data = $this->request->getPost();


        if ($data['order_id'] != "") {
            $order_detail = $this->order_model->select('fkclientid,fkvendorstaffid,categoryname')->find($data['order_id']);
            $lead_check = $this->lead_model->where('phone_number', $data['phone_number'])->where('client_id', $order_detail['fkclientid'])->where('camp_id', $order_detail['categoryname'])->first();

            $post_data = [
                "phone_number" => $data['phone_number'],
                "agent_name" => $data['agent_name'],
                "firstname" => $data['first_name'],
                "lastname" => $data['last_name'],
                "state" => $data['state'],
                "complete_lead" => json_encode($data),
                "order_id" => $data['order_id'],
                "status" => 3,
                "camp_id" => $order_detail['categoryname'],
                "vendor_id" => $order_detail['fkvendorstaffid'],
                "client_id" => $order_detail['fkclientid'],
                "master_search" => json_encode($data),
                "lead_date" => $data['date'],
                "assigned" => 1
            ];
        } else {
            $post_data = [
                "phone_number" => $data['phone_number'],
                "agent_name" => $data['agent_name'],
                "firstname" => $data['first_name'],
                "lastname" => $data['last_name'],
                "state" => $data['state'],
                "complete_lead" => json_encode($data),
                "order_id" => $data['order_id'],
                "status" => 3,
                "camp_id" => $data['camp_id'],
                "vendor_id" => "",
                "client_id" => "",
                "master_search" => json_encode($data),
                "lead_date" => $data['date'],

            ];
        }

        $insert_id = $this->lead_master_model->insert($post_data);



        if ($data['order_id'] != "") {
            if ($lead_check) {
                $session = session();
                $session->setFlashdata('error', 'Duplicate Lead Detected.');
                return redirect()->to('order-index')->withInput();
            }
            $this->lead_model->insert($post_data);
            $remaining = $this->order_model->update_order(1, $data['order_id']);
            if ($remaining == 0 || $remaining < 0) {

                $notification_data = [
                    'description' => 'Order Completed',
                    'to_user_id' => $order_detail['fkclientid'],
                    'link' => base_url() . "order-detail/" . $data['order_id'],
                ];
                add_notification($notification_data);
                // if (!is_vendor() && email_allowed('')) {
                //     send_email(get_email_by_user_id($post_data['vendor_id']), "Add Lead");
                // } // Order Complete Email
            }

            $notification_data = [
                'description' => '1 Lead Added to Order',
                'to_user_id' => $order_detail['fkclientid'],
                'link' => base_url() . "order-detail/" . $data['order_id'],
            ];

            add_notification($notification_data);

            if (email_allowed('vendorleads')) {
                send_email(get_email_by_user_id($post_data['vendor_id']), "Add Lead");
            }
            if (email_allowed('clientleads') && $post_data['client_id']!=0) {
                send_email(get_email_by_user_id($post_data['client_id']), "Add Lead", $post_data['vendor_id']);
            }
            if (email_allowed('adminleads')) {
                send_email("tshoaib10@gmail.com", "Add Lead");
            }

            $notification_data = [
                'description' => '1 Lead Added to Order',
                'to_user_id' => $order_detail['fkvendorstaffid'],
                'link' => base_url() . "order-detail/" . $data['order_id'],
            ];
            add_notification($notification_data);
            log_activity("Lead Added to Order  : " . $data['order_id'], get_user_fullname());
        } else {
            log_activity("Lead Added : ID :  " . $insert_id, get_user_fullname());
        }

        $session = session();
        $session->setFlashdata('success', 'Lead Added Sucessfully.');
       
        if ($data['order_id'] == "") {
            return redirect()->to('master-lead-index')->withInput();
        } else {
            return redirect()->to('order-index')->withInput();
        }
    }


    public function get_campaign_col()
    {
        $id = $this->request->getPost('orderId');
        $camp_col = $this->order_model->get_campain_col_by_order_id($id);
        echo json_encode($camp_col);
    }
    public function upload_lead()
{
    $session = session();
    $id = $this->request->getPost('order_id');
    $camp_id = $this->request->getPost('camp_id');
    $order_detail = $this->order_model->find($id);

    // Check if a file was uploaded
    $load_file = $this->request->getFile('csvfile');
    $fileExtension = pathinfo($load_file->getName(), PATHINFO_EXTENSION);

    if (!$load_file->isValid()) {
        // Set an error message
        $session->setFlashdata('error', 'File upload failed.');

        // Redirect back to the previous page
        return redirect()->back();
    }

    $newName = $load_file->getRandomName();
    $load_file->move('uploads/orders', "Order_ID_" . $id . "_" . $newName);

    if ($fileExtension === 'csv') {
        $session->set('uploaded_file', [
            'file_name' => './uploads/orders/' . "Order_ID_" . $id . "_" . $newName,
            'order_id' => $id,
            'camp_id' => $camp_id
        ]);

    }else if ($fileExtension === 'xlsx') {
        // Convert XLSX to CSV
        $xlsxFile = 'uploads/orders/' . "Order_ID_" . $id . "_" . $newName;
        $csvFile = 'uploads/orders/' . "Order_ID_" . $id . "_" . pathinfo($newName, PATHINFO_FILENAME) . '.csv';

        $excelReader = IOFactory::createReader('Xlsx');
        $excel = $excelReader->load($xlsxFile);
       
        $writer = IOFactory::createWriter($excel, 'Csv');
        $writer->setDelimiter(',');
        $writer->setEnclosure('"');
        $writer->setLineEnding("\r\n");
        $writer->save($csvFile);

        $session->set('uploaded_file', [
            'file_name' => $csvFile,
            'order_id' => $id,
            'camp_id' => $camp_id
        ]);

        unlink($xlsxFile);
    }

    

    return redirect()->to('map-headers');
}

    public function map_headers()
    {
        $session = session();
        $csvimport = new Csvimport();
        ini_set('memory_limit', '256M');

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Column Mapping']),
            'page_title' => view('partials/page-title', ['title' => 'Column Mapping', 'pagetitle' => 'Look For Leads']),
        ];

        $uploadedFile = $session->get('uploaded_file');

        if (!$uploadedFile) {
            return redirect()->to('upload-lead')->with('error', 'No file uploaded');
        }

        $import_data = $csvimport->get_array($uploadedFile['file_name']);
        $session->set('csv_array', $import_data);

        $data['headers'] = $import_data;
        if ($uploadedFile['order_id'] != "") {
            $mapping_headers = $this->order_model->get_camp_headers($uploadedFile['order_id']);
        } else {
            $mapping_headers = $this->order_model->get_camp_headers("", $uploadedFile['camp_id']);
        }
    
        foreach ($import_data[0] as $key => $value) {
            $header[] = $value;
        }
        $data['order_id']      = $uploadedFile['order_id'];
        $data['camp_id']       = $uploadedFile['camp_id'];
        $data['header']        = $header;
        $data['header_fields'] = $mapping_headers;
        return view('orders_management/map_headers', $data);
    }
    public function importLeads()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Orders']),
            'page_title' => view('partials/page-title', ['title' => 'All Orders', 'pagetitle' => 'Look For Leads']),
        ];

        $session = session();
        $o_id = $this->request->getPost('cid');
        $camp_id = $this->request->getPost('camp_id');


        $head_arr = $this->request->getPost('map_head');

        if ($o_id != "") {
            $order_detail = $this->order_model->select('fkclientid,fkvendorstaffid')->find($o_id);
            $mapping_headers = $this->order_model->get_camp_headers($o_id);
        } else {
            $mapping_headers = $this->order_model->get_camp_headers("", $camp_id);
        }
        $csv_array = $session->get('csv_array');
        $data['user_mapper'] = $head_arr;
        $data['headers_avail'] = $mapping_headers;

        $leads = array();

        foreach ($csv_array[1] as $row) {
         
            $temp = array();
            foreach ($head_arr as $key => $h) {
                if($h=="-"){
                    $temp[$mapping_headers[$key]] ="";
                }
                else{
                    if (isset($row[$h])) {
                        $temp[$mapping_headers[$key]] = $row[$h];
                    } else {
                        // Handle missing key
                        $temp[$mapping_headers[$key]] = null; // or some default value
                    }                }

            }
            array_push($leads, $temp);
        }
        $post_data = array();
        $duplicate = array();
        if ($o_id != "") {
            foreach ($leads as $l) {
                $lead_check = $this->lead_model->where('phone_number', $l['phone_number'])->where('client_id', $order_detail['fkclientid'])->where('camp_id', $camp_id)->first();
                $temp_post_data = [
                    "phone_number" => $l['phone_number'],
                    "agent_name" => $l['agent_name'],
                    "firstname" => $l['first_name'],
                    "lastname" => $l['last_name'],
                    "state" => $l['state'],
                    "complete_lead" => json_encode($l),
                    "order_id" => $o_id,
                    "camp_id" => $camp_id,
                    "vendor_id" => $order_detail['fkvendorstaffid'],
                    "client_id" => $order_detail['fkclientid'],
                    "status" => 3,
                    "master_search" => json_encode($l),
                    "assigned" => 1,
                    "lead_date" => date('Y-m-d', strtotime($l['date'])),


                ];
                if (!$lead_check) {
                    array_push($post_data, $temp_post_data);
                } else {
                    array_push($duplicate, $temp_post_data);
                }
            }
        } else {
            foreach ($leads as $l) {
                $temp_post_data = [
                    "phone_number" => $l['phone_number'],
                    "agent_name" => $l['agent_name'],
                    "firstname" => $l['first_name'],
                    "lastname" => $l['last_name'],
                    "state" => $l['state'],
                    "complete_lead" => json_encode($l),
                    "order_id" => "",
                    "camp_id" => $camp_id,
                    "vendor_id" => "",
                    "client_id" => "",
                    "status" => 3,
                    "master_search" => json_encode($l),
                    "lead_date" => date('Y-m-d', strtotime($l['date'])),

                ];
                array_push($post_data, $temp_post_data);
            }
        }

        $data['post_data'] = $post_data;
        $data['duplicate'] = $duplicate;
        $this->lead_master_model->insertBatch(array_merge($post_data, $duplicate));
        if ($o_id != "") {
            if ($post_data) {

                $this->lead_model->insertBatch($post_data);
            }
            $this->order_model->update_order(count($post_data), $o_id);
            $notification_data = [
                'description' => count($post_data) . 'Lead Added to Order',
                'to_user_id' => $order_detail['fkclientid'],
                'link' => base_url() . "order-detail/" . $o_id,
            ];
            add_notification($notification_data);
            if (!is_vendor()) {
                send_email(get_email_by_user_id($temp_post_data['vendor_id']), "Add Lead");
            }

            if($temp_post_data['client_id']!=0){
            send_email(get_email_by_user_id($temp_post_data['client_id']), "Add Lead");
        }
            log_activity("Leads Added " . count($post_data), get_user_fullname());
            $notification_data = [
                'description' => count($post_data) . ' Lead Added to Order',
                'to_user_id' => $order_detail['fkvendorstaffid'],
                'link' => base_url() . "order-detail/" . $o_id,
            ];
            add_notification($notification_data);
            $session = session();
            $session->setFlashdata('success', 'Leads Added.');
            return view('leads_management/bulk_lead_added_view', $data);
        } else {
            log_activity("Leads Added " . count($post_data), get_user_fullname());
        }

        $session = session();
        $session->setFlashdata('success', 'Leads Added.');
        return view('leads_management/bulk_lead_added_view', $data);
    }

    public function order_detail($id)
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Order Detail']),
            'page_title' => view('partials/page-title', ['title' => 'Order Detail', 'pagetitle' => 'Look For Leads']),
        ];

        $order = $this->order_model->find($id);
        $data["order"] = $order;
        // var_dump($order);
        // return 0;
        return view('orders_management/order_detail', $data);
    }

    public function delete($id)
    {
        $this->order_model->holdorder($id);
        log_activity("Order Set On Hold , ID : " . $id, get_user_id());
        redirect()->to('order-index');
    }

    public function block_order()
    {
        $orderId = $this->request->getPost('orderId');
        $response = $this->order_model->update($orderId, ["status" => 0]);
        echo json_encode($response);
    }
    public function unblock_order()
    {
        $orderId = $this->request->getPost('orderId');
        $orderId = $this->request->getPost('orderId');
        $response = $this->order_model->update($orderId, ["status" => 1]);
        echo json_encode($response);
    }

    public function order_api(){

        $id = $this->request->getGet('id');
        $token= $this->request->getGet('token');
        $page=$this->request->getGet('page');
        $offset=$this->request->getGet('offset');
        $user=$this->auth_model->find($id);
        if($user['token']==$token){
           if($user['userrole']==3){
            $orders=$this->order_model->where('fkclientid',$id)->countAllResults();            
            $pagination = array(
                "total_records" => $orders,
                "current_page" => $page,
                "total_pages" =>ceil($orders/10),
                "off_set" => $offset,
                "next_page" => intval($page)+1,
                "prev_page" => intval($page)-1,
            );
            $orders=$this->order_model->where('fkclientid',$id)->findAll(10,$offset);  
            $response['orders']=$orders;
            $pagination['current_records']=count($orders);
            $response['pagination']=$pagination;
           }
           elseif($user['userrole']==2){
            $orders=$this->order_model->where('fkvendorstaffid',$id)->findAll();

            $response['leads']=$orders;
           }
           $response['message']="Sucessfull";
        }else{
            $response['message']=$this->fail('', 403,'Forbidden');
        }
        
        echo json_encode($response);
    }

    public function dashboard_api(){

        $id = $this->request->getGet('id');
        $token= $this->request->getGet('token');

        echo json_encode($id);

    }
}
