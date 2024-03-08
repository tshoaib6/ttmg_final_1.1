<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Campaign;

use App\Controllers\BaseController;
use App\Models\Order;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;

class CampaignController extends BaseController
{
    protected $request;
    protected $campaign_model;
    protected $auth_model;
    protected $order_model;


    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->auth_model = new Auth;
        $this->campaign_model = new Campaign;
        $this->order_model=new Order;
        $this->data = ['session' => $this->session];
    }

    public function index()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Campaigns']),
            'page_title' => view('partials/page-title', ['title' => 'All Campaigns', 'pagetitle' => 'TTMG']),
        ];
        $data['campaigns'] = $this->campaign_model->orderBy('id', 'DESC')->findAll();
        return view('campaigns/index', $data);
    }

    public function get_campaign_api(){
        helper('text');
       $camp= $this->campaign_model->select('id,campaign_name')->findAll();
        $token=random_string('alnum','40');
        update_option("token",$token);
       $data=array(
        "camp" => $camp,
        'token' => $token
       );
        echo json_encode($data);
    }

    public function ajaxDataTables()
    {
        $db = db_connect();
        $builder = $db->table('ttmg_campaign')->select('campaign_name, campaign_columns,id', );
        $data = DataTable::of($builder)->edit('id', function ($row) {
            $has_orders=$this->order_model->where('categoryname',$row->id)->get()->getResult();
            if($has_orders){
                return '<a href="#" class="px-3" style="cursor: not-allowed" onclick="return false;" text-primary"><i class="uil uil-pen font-size-18"></i></a>
                <a href="#" class="px-3"  style="cursor: not-allowed" onclick="return false; "text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>';
            }
            else{
                return '<a href="' . site_url('create-campaign/') . $row->id . '" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                <a href="' . base_url('campaign-delete/') . $row->id . '" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>';
            }
            
        })->edit('campaign_columns', function ($row) {
            $output = `<div class="d-flex justify-content-between"`;
            $jsonString = str_replace('&quot;', '"', $row->campaign_columns);
            $temp = json_decode($jsonString);
            foreach ($temp as $c) {
                $output .= "<span class=\"badge bg-success\">" . $c->col_name;
                $output .= "</span></div>";
            }
            return $output;
        })->edit('campaign_name', function ($row) {
           
            return '<a href="' . site_url('campaign-detail/') . $row->id . '" class="px-3 text-primary">'.$row->campaign_name.'</a>';
        })
            ->addNumbering() //it will return data output with numbering on first column
            ->toJson();
        return $data;

    }


    public function create($id = "")
    {

        if ($this->request->getMethod() === 'post') {

            $colNames = $this->request->getPost('col_name');
            $colSlugs = $this->request->getPost('col_slug');
            $colTypes = $this->request->getPost('col_type');
            $colDefaults = $this->request->getPost('col_default');


            $rules = [
                'campaign_name' => 'required|is_unique[campaign.campaign_name]',
            ];


            $messages = [
                'campaign_name' => [
                    'is_unique' => 'The {field} must be unique.',
                ],
            ];

            if (!$this->validate($rules, $messages)) {
                return redirect()->to('create-campaign')->withInput()->with('errors', $this->validator->getErrors());
            }
            $resultArray = [];

            for ($i = 0; $i < count($colNames); $i++) {
                $resultArray[] = [
                    'col_name' => $colNames[$i],
                    'col_slug' => $colSlugs[$i],
                    'col_type' => $colTypes[$i],
                    'col_default' => $colDefaults[$i]
                ];
            }



            $data = [
                'campaign_name' => $this->request->getPost('campaign_name'),
                'campaign_columns' => json_encode($resultArray),
            ];

            if ($this->request->getPost('id')) {
                $id = $this->request->getPost('id');
                $result = $this->campaign_model->deleteCampaign($id);
            }

            if ($this->campaign_model->isUniqueCampaignName($data['campaign_name'])) {


                $this->campaign_model->insert($data);
                if(is_admin() && email_allowed("admincampaign") ){
                    send_email(get_email_by_user_id(get_user_id()),"Add Campaign");
                }
                session()->setFlashdata('success', 'Campaign Added Successful!');
                log_activity("Campaign : " . $data["campaign_name"] . " Added", get_user_id());
                return redirect()->to('campaign-index');
            } else {
                session()->setFlashdata('error', 'Campaign name must be unique.');
                return redirect()->to('create-campaign')->withInput();
            }
        } elseif ($id != "") {
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'Edit Campaign']),
                'page_title' => view('partials/page-title', ['title' => 'Edit Campaign', 'pagetitle' => 'TTMG']),
            ];
            $data['camp'] = $this->campaign_model->find($id);

        } else {
            $data = [
                'title_meta' => view('partials/title-meta', ['title' => 'New Campaign']),
                'page_title' => view('partials/page-title', ['title' => 'New Campaign', 'pagetitle' => 'TTMG']),
            ];
            return view('campaigns/add_campaign', $data);
        }
        return view('campaigns/add_campaign', $data);
    }

    public function delete($id)
    {



        $result = $this->campaign_model->deleteCampaign($id);
        log_activity("Campaign Deleted" . json_encode($result), get_user_id());
        return  redirect()->to('campaign-index');
    }

    public function campaign_detail($id)
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Campaign Detail']),
            'page_title' => view('partials/page-title', ['title' => 'Campaign Detail', 'pagetitle' => 'TTMG']),
        ];

        $camp=$this->campaign_model->select('id,campaign_name')->find($id);
        if($camp){
            $data["campaign"]=$camp;
        }
        else{
            $data["campagin"]="N/A";

        }
       
        return view('campaigns/campaign-detail', $data);
    }

}
