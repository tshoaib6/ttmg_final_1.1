<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Models\Auth as Auth_Model;
use App\Models\ActivityLog as Activity;

class ActivityLog extends BaseController
{
    protected $auth_model;
    protected $activity_model;

    public function __construct()
    {
        $this->auth_model = new Auth_Model;
        $this->activity_model = new Activity;
    }

    public function index()
    {
       $session = session();
       $data=[];
       $data['page_title'] = "Activity Log";
       $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Activity Log']),
            'page_title' => view('partials/page-title', ['title' => 'Activity Log', 'pagetitle' => 'Home'])
        ];
        $data['clients'] = $this->auth_model->select('id,firstname,lastname')->where('userrole',3)->findAll();
        $data['vendors'] = $this->auth_model->select('id,firstname,lastname')->where('userrole',2)->findAll();
        return view('activity/all-activities',$data);
    }

    public function deleteActivity($id)
    {
        $session = session();
        $this->activity_model->Delete($id);
        $session->setFlashdata('success','Activity Deleted.');
        return redirect()->to('/all-activities');
    }

    public function ajaxActivitiesLogs()
    {
         $db = db_connect();
        $builder = $db->table('activitylog')
        ->select('id,full_name, description, created_at'); 

        return DataTable::of($builder)
        
        ->edit('created_at',function($row){
            return time_ago($row->created_at);
        })
        
        ->add('Action',function($row){
            
          return '<a href="'.base_url('delete-activity/').$row->id.'" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>';   
        },'last')

        ->filter(function ($builder, $request) {
        
            if ($request->filter_client){
                $builder->where('user_id', $request->filter_client);
            }

             if ($request->filter_vendor){
                $builder->where('user_id', $request->filter_vendor);
            }

            if ($request->start_date != '' && $request->end_date != ''){

               $builder->where("DATE_FORMAT(created_at,'%m-%d-%Y') >=",$request->start_date);
               $builder->where("DATE_FORMAT(created_at,'%m-%d-%Y') <=",$request->end_date);
            }

        })
        ->toJson();
    }
}
