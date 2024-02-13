<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Referral as Referral_model;
use App\Models\Auth as Auth_Model;
use \Hermawan\DataTables\DataTable;

class Referral extends BaseController
{
    protected $referral_model;
    protected $auth_model;

    public function __construct()
    {
        $this->referral_model = new Referral_model;
        $this->auth_model = new Auth_Model;
    }

    public function index()
    {
        $data['page_title'] = "Referral";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Referral']),
            'page_title' => view('partials/page-title', ['title' => 'Referral', 'pagetitle' => 'Home'])
        ];
        
        return view('referral/manage-referral', $data);
    }

    public function addReferral()
    {
        helper('text');
        $session = session();        
        if($this->request->getMethod() == 'post')
        {
            $email = $this->request->getPost('client-email');
            $fullName = $this->request->getPost('client-name');
            $checkEmail = $this->referral_model->where('email', $email)->countAllResults();
            if($checkEmail > 0)
            {
                 $session->setFlashdata('error','Referral Email already Exist!');
                 return redirect()->to('all-referral');

            }else
            {
                $idata = [
                    'full_name' => $fullName,
                    'email'  => $email,
                    'user_id' => 0,
                    'vendor_id' => get_user_id(),
                    'token' => random_string('alnum','40'),
                ];

                $save = $this->referral_model->insert($idata);
                $insert_id = $this->referral_model->insertID();
                if($save){
                    $session->setFlashdata('success','Referral email has been sent.');

                    $notification_data = [
                                    'description' =>'New referral added. Full Name: '.$idata['full_name'],
                                    'to_user_id' => 1,
                                    'link' => base_url(),
                                ];
                    add_notification($notification_data); 
                    $link = base_url('referral-signup/'.$insert_id.'/'.$idata['token']);
                    send_referral_email($idata['email'], $idata['full_name'], get_user_fullname(), $link );          
                    return redirect()->to('all-referral');
                }else
                {
                    $session->setFlashdata('error','Failed to save data.');
                    return redirect()->to('all-referral');
                }
            }
        }
    }

    public function deleteReferral($id)
    {
        $idata = $this->referral_model->where('id',$id)->first();
        $session = session();
        log_activity('Referral Deleted [Email: '.$idata['email'].'] by Vendor: ['.get_user_id($idata['vendor_id']).']');

        $this->referral_model->delete(['id' => $id]);

        $session->setFlashdata('success','Referral deleted Successfully.');

        return redirect()->to('/all-referral');
    }

    public function sendReferralEmail($id)
    {
        $rdata = $this->referral_model->where('id',$id)->first();
        $session = session();
        if(strlen($rdata['token']) > 0)
        {
            $link = base_url('referral-signup/'.$id.'/'.$rdata['token']);
            send_referral_email($rdata['email'], $rdata['full_name'], get_user_fullname($rdata['vendor_id']), $link );          
            $session->setFlashdata('success','Referral email has been sent.');

        }else{

            $session->setFlashdata('error','Referral token is missing.');

        }
        return redirect()->to('/all-referral');
    }

    public function referralSignup($id, $token)
    {
        $referral = $this->referral_model->where('id',$id)->where('token',$token)->countAllResults();
        $session = session();
        $data['page_title'] = "Client Signup";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Client Signup']),
            'page_title' => view('partials/page-title', ['title' => 'Client Signup', 'pagetitle' => 'Home'])
        ];
        if($referral > 0)
        {
           $rdata = $this->referral_model->where('id',$id)->first();
           $user_data = $this->auth_model->where('id',$rdata['vendor_id'])->first();
           
           if($user_data)
           {
                $session->set('branch_set',1);
                foreach($user_data as $k => $v)
                {
                    $session->set('branch_'.$k, $v);
                }
           }

           $data['vendor_id'] = $rdata['vendor_id'];
           $data['referral_id'] = $id;
           $data['referral_token'] = $token;
           $data['ref_link'] = base_url('referral-signup/'.$id.'/'.$token);

        }else{

            $data['link_expired'] = 'Link is expired please contact your vendor.';
        }

        return view('referral/referral-signup', $data);
        
    }

    public function ajaxAllReferral()
    {
        $db = db_connect();
        $builder = $db->table('ttmg_referral')
        ->select('id,full_name,email,user_id, created_at,token');

        if(is_vendor())
        {
            $builder->where('vendor_id', get_user_id()); 
        }        

        return DataTable::of($builder)
        ->edit('user_id',function($row){
            $user_id = '';
            if($row->user_id == 0)
            {
               $user_id = '<span class="badge bg-primary">Email Sent</span>'; 
            }else 
            {
                $user_id = '<span class="badge bg-success">Client Acceppted</span>';
            }
            return $user_id;
        })
        ->edit('created_at', function($row){
            return customDateFormatter($row->created_at);
        })
        ->add('Action',function($row){
            $email = '';
            if(strlen($row->token) > 0){
                $email = '<a href="'.base_url('send-referral-email/').$row->id.'" class="px-3 text-primary"><i class="uil uil-envelope-alt font-size-18"></i> Send Email</a>';
            }
          return '<a href="'.base_url('delete-referral/').$row->id.'" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>'.$email;   
        },'last')

        ->toJson();
    }
}
