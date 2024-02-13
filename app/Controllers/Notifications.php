<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Notifications as Notify_model;

class Notifications extends BaseController
{
    protected $notifications_model;

    public function __construct()
    {
        $this->notifications_model = new Notify_model;
    }

    public function index()
    {
        $session = session();
        $limit = 10;
        $start = 0;
        $data=[];
        $data['page_title'] = "Notifications";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Notifications']),
            'page_title' => view('partials/page-title', ['title' => 'Notifications', 'pagetitle' => 'Home'])

        ];
        $data['page'] = 0;
        
        if($this->request->getMethod() == 'post') 
        {

            $page   = (int)$this->request->getPost('page') + 1;
            $start = ($page * $limit);
            $data['page'] = $page;

             if($session->login_userrole == 1)
            {
                 $notifications = $this->notifications_model->limit($limit,$start)->orderBy('id','desc')->find();
                 $data['total_pages'] = $this->notifications_model->countAllResults() / $limit;
            }else
            {
                $notifications = $this->notifications_model->where('to_user_id',$session->login_id)->limit($limit,$start)->orderBy('id','desc')->find();
                $data['total_pages'] = $this->notifications_model->where('to_user_id',$session->login_id)->countAllResults() / $limit;
            }

            $html = '';
            foreach($notifications as $row)
            {
                if(!$row['isread'])
                { 
                    $read = 'unread';
                    $readscript = '<span class="bg-warning badge me-2">unread</span>';
                }else
                {
                    $read = 'read';
                    $readscript = '<span class="bg-success badge me-2">read</span>';
                }

                $html.= '<li class="'.$read.'">
                            <div class="col-mail col-mail-1">
                                <div class="ml-3">
                                <img src="'.base_url('uploads/users/').get_user_image($row['from_user_id']).'" alt="" class="rounded-circle avatar-sm">
                                </div>
                                <a href="#" class="title" data-link="'.$row['link'].'" data-id="'.$row['id'].'" data-blank ="1" onClick="notification_read_unread(this)">'.$row['from_full_name'].'


                                </a>
                            </div>
                                <div class="col-mail col-mail-2">
                                <a href="#" class="subject" data-link="'.$row['link'].'" data-id="'.$row['id'].'" data-blank ="1" onClick="notification_read_unread(this)">
                                 '.$readscript.' '.$row['description'].'
                                </a>
                            <div class="date">'.time_ago($row['created_at']).'</div>
                            </div></li>';
            }

            $data = 
            [
                'html' => $html,
                'page' => $page
            ];

            echo json_encode($data);
            die;
        }

        if($session->login_userrole == 1)
        {
             $data['all_notifications'] = $this->notifications_model->limit($limit,$start)->orderBy('id','desc')->find();
              $data['total_pages'] = $this->notifications_model->countAllResults() / $limit;
        }else
        {
            $data['all_notifications'] = $this->notifications_model->where('to_user_id',$session->login_id)->limit($limit,$start)->orderBy('id','desc')->find();
             $data['total_pages'] = $this->notifications_model->where('to_user_id',$session->login_id)->countAllResults() / $limit;
        }
       
        return view('notifications/allnotifications', $data);
    }

    public function ajax_top_notification()
    {
        $html = '';
        $session = session();
        $notifications = $this->notifications_model->where('to_user_id',$session->login_id)->limit(5)->orderBy('id','desc')->find();
        $unread = $data['total_pages'] = $this->notifications_model->where('isread',0)->where('to_user_id',$session->login_id)->countAllResults();

        $read = '';
        foreach($notifications as $row)
        {
              if(!$row['isread'])
                { 
                    $read = 'unread';
                }else{
                    $read = '';
                }

            $html .='<a href="#" class="text-dark notification-item " data-link="'.$row['link'].'" data-id="'.$row['id'].'" onClick="notification_read_unread(this)" data-blank ="0">
                            <div class="d-flex align-items-start '.$read.'">
                                <div class="flex-shrink-0 me-3">
                                    <img src="'.base_url('uploads/users/').get_user_image($row['from_user_id']).'" class="rounded-circle avatar-xs" alt="user-pic">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">'.$row['from_full_name'].'</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">'.$row['description'].'</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i>'.time_ago($row['created_at']).'</p>
                                    </div>
                                </div>
                            </div>
                        </a>';
        }

        $data= [

                'notifications' => $html,
                'countnotifications' => $unread 
        ];

        echo json_encode($data);
        die;
    }

    public function ajax_top_notification_read($nid)
    {
        if(is_numeric($nid))
        {
            $idata = ['isread' => 1];
            $this->notifications_model->update($nid,$idata);
        }else
        {
            $idata = ['isread' => 1];
            $this->notifications_model->set($idata);
            $this->notifications_model->where('to_user_id',get_user_id());
            $this->notifications_model->update();
        } 
        $message = ['success' => 1];
        echo json_encode($message);
    }
}
