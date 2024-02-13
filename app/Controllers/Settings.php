<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Settings extends BaseController
{
    public function index()
    {
        $data=[];
        $data['page_title'] = "System Settings";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'System Settings']),
            'page_title' => view('partials/page-title', ['title' => 'System Settings', 'pagetitle' => 'Home'])

        ];
        $data['data']=$this->request;
        $session = session();
        if($this->request->getMethod() == 'post')
        {

            $companylogofile = '';
                if($companylogofile = $this->request->getFile('companylogo')) 
                { 

                    $input = $this->validate([
                     'companylogo' => 'uploaded[companylogo]|max_size[companylogo,1024]|ext_in[companylogo,jpg,jpeg,png],'
                     ]);

                    if (!$input) 
                    { 
                       $companylogofile = '';
                       $session->setFlashdata('error',$this->validator->getErrors());

                    }else{

                        if(option_exists('companysettings'))
                        {

                            $logoname = json_decode(get_option('companysettings'),1);
                            if(strlen($logoname['ttmg_companylogo']) > 0 )
                            {
                                if(is_file('uploads/'.$logoname['ttmg_companylogo']))
                                 {
                                     unlink('uploads/'.$logoname['ttmg_companylogo']);
                                 }
                            }
                        } 

                         $newName = $companylogofile->getRandomName(); 
                         $companylogofile->move('uploads/', $newName);
                         $companylogofile = $newName;
                     }

                } 

                $idata = 
                   [
                        'companyname'       => $this->request->getPost('companyname'),
                        'contactdetails'   => $this->request->getPost('contactdetails'),
                        'aboutcompany'   =>  $this->request->getPost('aboutcompany'),
                        'companylogo'   => $companylogofile,
                        'logoheight'   => $this->request->getPost('logoheight'),
                        'logowidth'    => $this->request->getPost('logowidth'),
                   ];

            update_option('companysettings',json_encode($idata));

            $session->setFlashdata('success','Settings saved successfully!');
        }
        if(option_exists('companysettings'))
        {
            $data['cs_data'] = json_decode(get_option('companysettings'),1);
        }
        
        $data['session'] = $session;
        return view('settings/system-settings',$data);
    }
}
