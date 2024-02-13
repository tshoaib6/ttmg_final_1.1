<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Auth as Auth_Model;

class Auth extends Seeder
{
    public function run()
    {
        $auth_model = new Auth_Model;
        $auth_model->save([
            'firstname'=>'admin',
            'lastname' => 'crm',
            'email'   => 'admin@eraxon.com',
            'password'=> '123456789',
            'useruimage'=>null,
            'userrole'=> 1,
            'smtpemail'=>null,
            'smtppassword'=>null,
            'smtpincomingserver'=>null,
            'smtpoutgoingserver'=>null,
            'smtpport'=>null,
            'branchname'=>null,
            'branchslug'=>null,
            'branchcountry'=>null,
            'branchaddress'=>null,
            'brancheader'=>null,
            'branchnavbar'=>null,
            'branchnavtext'=>null,
            'branchnavhover'=>null,
            'branchlogo'=>null,
            'branchlogoheight'=>null,
            'branchlogowidth'=>null,
            'block'=> 0,            
        ]);
    }
}
