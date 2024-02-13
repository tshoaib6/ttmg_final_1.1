<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmailTemplate as Email_Model;
use \Hermawan\DataTables\DataTable;

class EmailTemplate extends BaseController
{
    protected $request;
    protected $emailtemplate_model;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->emailtemplate_model = new Email_Model;
    }

    public function index()
    {
       
        $data=[];
        $data['page_title'] = "All Email Templates";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Email Tempaltes']),
            'page_title' => view('partials/page-title', ['title' => 'Home', 'pagetitle' => 'Home'])
        ];
        return view('emailTemplate/all-templates', $data);
    }

    public function editTemplate($id)
    {
        $data=[];
        $data['page_title'] = "Edit Email Template";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Edit Email Templates']),
            'page_title' => view('partials/page-title', ['title' => 'Edit Email Templates', 'pagetitle' => 'Settings'])
        ];
        $session = session();
        if($this->request->getMethod() == 'post')
        {
            $idata = [
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
                             ];
             $update = $this->emailtemplate_model->update($id,$idata);

                if($update){
                    $session->setFlashdata('success','Email Template has been updated sucessfully.');
                }else
                {
                    $session->setFlashdata('error','Failed to update data.');
                }                 

        }
        $data['template'] = $this->emailtemplate_model->where('id',$id)->first();
        $data['session'] = $session;  
        return view('emailTemplate/edit-template', $data);
    }

    public function ajaxAllEmailTemplates()
    {
        $db = db_connect();
        $builder = $db->table('emailtemplate')
        ->select('id,subject,message,user,event');
        return DataTable::of($builder)
        ->add('Action',function($row){
           
          return '<a href="'.site_url('editTemplate/').$row->id.'" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>';   
        },'last')

        ->toJson();
    }
}
