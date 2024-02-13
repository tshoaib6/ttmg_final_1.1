<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Support as Support_Model;

class Support extends BaseController
{
    protected $support_model;

    public function __construct()
    {
        $this->support_model = new Support_Model;
    }

    public function index()
    {
       $session = session();
       $data=[];
       $data['page_title'] = "Request & Support";
       $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Request & Support']),
            'page_title' => view('partials/page-title', ['title' => 'Request & Support', 'pagetitle' => 'Home'])
        ];
        
        //$data['clients'] = $this->auth_model->select('id,firstname,lastname')->where('userrole',3)->findAll();
        //$data['vendors'] = $this->auth_model->select('id,firstname,lastname')->where('userrole',2)->findAll();
        return view('support/main',$data);
    }

    public function ajaxUserList()
    {
       $html = '';
       $read = '';
       $viewedCounter = 0;
       $viewedtxt = '';
       $users = $this->support_model->groupBy('sender_id')->findAll();

       foreach($users as $row)
       {
            $viewCount = $this->support_model->where('sender_id',$row['sender_id'])->where('viewed_by_admin',0)->where('receiver_id',0)->orderBy('id','DESC')->countAllResults();
            if($viewCount > 0)
            {
                $read = 'class="unread"';
                $viewedCounter = $viewCount;
            }
            if($viewedCounter > 0)
            {
                $viewedtxt = '<div class="unread-message">
                            <span class="badge bg-danger rounded-pill">'.$viewedCounter.'</span>
                            </div>';
            }

            $html .=' <li '.$read.' data-id="'.$row['sender_id'].'" data-name="'.$row['sender_full_name'].'">
                    <a href="#">
                    <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3 align-self-center">
                    <div class="user-img online">
                       <img src="'.base_url('uploads/users/').get_user_image($row['sender_id']).'" class="rounded-circle avatar-xs" alt="">
                    </div>
                    </div>

                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-truncate font-size-14 mb-1">'.$row['sender_full_name'].'</h5>
                            <div class="font-size-11">'.time_ago($row['created_at']).'</div>
                    </div>
                    <div class="flex-shrink-0">
                            '.$viewedtxt.'
                    </div>
                    </div>
                </a>
            </li>';
       }

       $output = [
        'html' => $html,
       ];

       echo json_encode($output);
    }

    public function ajaxUserChat($sid)
    {
       $html = '';
       $read = '';
       $viewedCounter = 0;
       $viewedtxt = '';
       $chats = $this->support_model->where('sender_id',$sid)->findAll();

       //viewed by admin
       $viewed_data = ['viewed_by_admin' => 1]; 
       $viewed = $this->support_model->where('sender_id',$sid)->set($viewed_data)->update();

       foreach($chats as $row)
       {
        if($row['receiver_id'] == 0)
        { 
         $html .= '<li>
                    <div class="conversation-list">
                    <div class="ctext-wrap">
                        <div class="ctext-wrap-content">
                        <h5 class="font-size-14 conversation-name"><a href="#" class="text-reset ">'.$row['sender_full_name'].'</a> <span class="d-inline-block font-size-12 text-muted ms-2">'.time_ago($row['created_at']).'</span></h5>
                        <h6>['.$row['request_type'].']</h6>
                        <p class="mb-0">
                            '.$row['message'].'
                        </p>
                        </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onClick="delete_msg(this,"'.$row['id'].'")">Delete</a>
                        </div>
                    </div>
                    </div>
                    </div>
                </li>';  
            }
            if($row['receiver_id'] == 1)
            {   
                $html .= '<li class="right">
                        <div class="conversation-list">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    <h5 class="font-size-14 conversation-name"><a href="#" class="text-reset ">Support Service</a> <span class="d-inline-block font-size-12 text-muted ms-2">'.time_ago($row['created_at']).'</span></h5>
                                    <p class="mb-0">
                                            '.$row['message'].'
                                    </p>
                                </div>
                            <div class="dropdown align-self-start">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-ellipsis-v"></i>
                                 </a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onClick="delete_msg(this,"'.$row['id'].'")">Delete</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </li>';
            }
       }
       $output = [
        'html' => $html,
       ];

       echo json_encode($output);
    }

    public function ajaxClientMsgSend()
    {
        if($this->request->getMethod() == 'post')
        {
            $data = [
                'request_type' => $this->request->getPost('request_type'),
                'message'      => $this->request->getPost('message'),
                'sender_id'    => $this->request->getPost('user_id'),
                'receiver_id'  => 0,
                'sender_full_name' => $this->request->getPost('user_name'),
            ];

            $save = $this->support_model->insert($data);
            $insert_id = $this->support_model->insertID();
            
        }
    }

    public function ajaxSupportMsgSend()
    {
        if($this->request->getMethod() == 'post')
        {
            $data = [
                'request_type' => '',
                'message'      => $this->request->getPost('message'),
                'sender_id'    => $this->request->getPost('user_id'),
                'receiver_id'  => 1,
                'sender_full_name' => $this->request->getPost('user_name'),
            ];

            $save = $this->support_model->insert($data);
            $insert_id = $this->support_model->insertID();
            
        }
    }
}
