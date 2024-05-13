<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LeadMaster;
use App\Models\Order;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Auth as Auth_Model;
use App\Models\Referral as Referral_model;
use \Hermawan\DataTables\DataTable;

class Auth extends BaseController
{
    protected $request;
    protected $auth_model;
    protected $referral_model;
    protected $lead_master_model;
    protected $order_model;


    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->auth_model = new Auth_Model;
        $this->referral_model = new Referral_model;
        $this->lead_master_model= new LeadMaster;
    }

    public function index()
    {
        if (session()->login_id) {


            return redirect()->to('/home');
        }
        $data = [];
        $session = session();
        $data['page_title'] = "Login";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Login'])
        ];

        //Branch Mechanism
        $request = \Config\Services::request();
        if ($request->uri->getTotalSegments() > 1) {
            $param = $request->uri->getSegment(2);
            $v = url_clean($param);

            $styling = $this->auth_model->where('branchslug', $v)->first();
            if ($styling) {
                $session->set('branch_set', 1);
                foreach ($styling as $k => $v) {
                    $session->set('branch_' . $k, $v);
                }
            }
        } else {
            $session->remove('branch_set');
        }

        $data['session'] = $session;
        return view('auth-login', $data);
    }

    public function login()
    {

        $data = [];
        $session = session();
        $data['page_title'] = "Login";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Login'])
        ];
        $data['data'] = $this->request;
        if ($this->request->getMethod() == 'post') {
            $user = $this->auth_model->where('email', $this->request->getPost('email'))->first();
            if ($user) {
                $verify_password = $this->auth_model->where('password', $this->request->getPost('password'))->first();
                if ($verify_password) {
                    if ($user['block'] == 1) {
                        $session->setFlashdata('error', 'Your Account is not yet validated.');
                    } elseif ($user['block'] == 2) {
                        $session->setFlashdata('error', 'Your Account has been banned.');
                    } elseif ($user['block'] == 0) {
                        foreach ($user as $k => $v) {
                            $session->set('login_' . $k, $v);
                        }
                        log_activity('User Login [email: ' . session()->login_email . ', Role:' . get_user_role(session()->login_userrole) . ']');
                        return redirect()->to('/home');
                    } else {
                        $session->setFlashdata('error', 'User Account Status invalid.');
                    }
                } else {
                    $session->setFlashdata('error', 'Incorrect Password');
                }
            } else {
                $session->setFlashdata('error', 'Incorrect Email or Password');
            }
        }
        $data['session'] = $session;
        return view('auth-login', $data);
    }

    public function profile()
    {
        $session = session();
        $data = [];
        $data['page_title'] = "Profile";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Profile']),
            'page_title' => view('partials/page-title', ['title' => 'Profile', 'pagetitle' => 'Home'])
        ];
        $data['duser'] = $this->auth_model->where('id', get_user_id())->findAll();
        $data['session'] = $session;
        return view('user-profile', $data);
    }

    public function logout()
    {
        $session = session();
        log_activity('User Logout [email: ' . $session->login_email . ', Role:' . get_user_role(session()->login_userrole) . ']');
        $session->destroy();
        if ($session->has('branch_set')) {
            return redirect()->to('/login/' . $session->branch_branchslug);
        }
        return redirect()->to('/');
    }

    public function referral_register()
    {

        $data = [];
        $data['page_title'] = "Registraion";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'User Registeration']),
            'page_title' => view('partials/page-title', ['title' => 'User Registeration', 'pagetitle' => 'Home'])

        ];
        $data['data'] = $this->request;
        $data['vendors'] = $this->auth_model->select('id,firstname,lastname')->where('userrole', 2)->findAll();
        $session = session();
        if ($this->request->getMethod() == 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $ref_link = $this->request->getPost('ref_link');
            $checkEmail = $this->auth_model->where('email', $email)->countAllResults();


            if ($checkEmail > 0) {
                $session->setFlashdata('error', 'Email is already exist. Please login');
                return redirect()->to('login/');
            } else {

                $role = $this->request->getPost('role');
                $agentpic = '';
                if ($agentpic = $this->request->getFile('agentpicture')) {

                    $input = $this->validate([
                        'agentpicture' => 'uploaded[agentpicture]|max_size[agentpicture,1024]|ext_in[agentpicture,jpg,jpeg,png],'
                    ]);

                    if (!$input) {
                        $agentpic = '';
                        //$session->setFlashdata('error','Agent Picture not found.');
                    } else {

                        $newName = $agentpic->getRandomName();
                        $agentpic->move('uploads/users', $newName);
                        $agentpic = $newName;
                    }

                }
                if ($role == 1) //admin
                {
                    $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            'useruimage' => $agentpic,
                            'userrole' => 1,
                            'vendor' => 0,
                            'block' => 0
                        ];
                } else if ($role == 2) //vendor
                {
                    $branchlogo = '';
                    if ($branchlogo = $this->request->getFile('branchlogo')) {

                        $input = $this->validate([
                            'branchlogo' => 'uploaded[branchlogo]|max_size[branchlogo,1024]|ext_in[branchlogo,jpg,jpeg,png],'
                        ]);

                        if (!$input) {
                            $branchlogo = '';

                        } else {

                            $newName = $branchlogo->getRandomName();
                            $branchlogo->move('uploads/users', $newName);
                            $branchlogo = $newName;
                        }

                    }
                    $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            'useruimage' => $agentpic,
                            'vendor' => 0,
                            'smtpemail' => $this->request->getPost('smtpemail'),
                            'smtppassword' => $this->request->getPost('smtppassword'),
                            'smtpincomingserver' => $this->request->getPost('smtpincomingserver'),
                            'smtpoutgoingserver' => $this->request->getPost('smtpoutgoingserver'),
                            'smtpport' => $this->request->getPost('smtpport'),
                            'branchname' => $this->request->getPost('branchname'),
                            'branchslug' => $this->request->getPost('branchslug'),
                            'branchcountry' => $this->request->getPost('branchcountry'),
                            'branchaddress' => $this->request->getPost('branchaddress'),
                            'brancheader' => $this->request->getPost('brancheader'),
                            'branchnavbar' => $this->request->getPost('branchnavbar'),
                            'branchnavtext' => $this->request->getPost('branchnavtext'),
                            'branchnavhover' => $this->request->getPost('branchnavhover'),
                            'branchlogo' => $branchlogo,
                            'branchlogoheight' => $this->request->getPost('branchlogoheight'),
                            'branchlogowidth' => $this->request->getPost('branchlogowidth'),
                            'userrole' => 2,
                            'block' => 0
                        ];
                } else if ($role == 3) //client
                {
                    $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            //'useruimage' => $agentpic,
                            'userrole' => 3,
                            'vendor' => implode(', ', $this->request->getPost('vendor')),
                            'block' => 0
                        ];
                }

                $save = $this->auth_model->insert($idata);
                $insert_id = $save;
                if ($save) {
                    $session->setFlashdata('success', 'Your Account has been register sucessfully. ');

                    //update token and add user ID into referral table
                    $referral_id = $this->request->getPost('referral_id');
                    $vendor_id = $idata['vendor'];

                    $vendor_slug = $this->auth_model->where('id', $vendor_id)->first();

                    $udata = [
                        'user_id' => $insert_id,
                        'token' => ''
                    ];
                    $this->referral_model->update($referral_id, $udata);
                    log_activity('New referral client account has been created. Vendor[' . get_user_fullname($vendor_id) . '] Clien[' . get_user_fullname($insert_id) . ']');
                    return redirect()->to('login/' . $vendor_slug['branchslug']);
                } else {

                    $session->setFlashdata('error', 'Failed to perform request.');
                    return redirect()->to($ref_link);
                }
            }


        }
        $data['session'] = $session;

        return view('user-register', $data);
    }

    public function register()
    {
        

        $data = [];
        $data['page_title'] = "Registraion";
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'User Registeration']),
            'page_title' => view('partials/page-title', ['title' => 'User Registeration', 'pagetitle' => 'Home'])

        ];
        $data['data'] = $this->request;
        $data['vendors'] = $this->auth_model->select('id,firstname,lastname')->where('userrole', 2)->findAll();
        $session = session();
        if ($this->request->getMethod() == 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $checkEmail = $this->auth_model->where('email', $email)->countAllResults();
            if ($checkEmail > 0) {
                $session->setFlashdata('error', 'Email is already taken.');
            } else {

                $role = $this->request->getPost('role');
                $agentpic = '';
                if ($agentpic = $this->request->getFile('agentpicture')) {

                    

                    $input = $this->validate([
                        'agentpicture' => 'uploaded[agentpicture]|max_size[agentpicture,1024]|ext_in[agentpicture,jpg,jpeg,png],'
                    ]);

                    if (!$input) {
                        $agentpic = '';
                        //$session->setFlashdata('error','Agent Picture not found.');
                    } else {

                        $newName = $agentpic->getRandomName();
                       
                        $agentpic->move('uploads/users', $newName);
                        $agentpic = $newName;
                    }

                }
                if ($role == 1) //admin
                {
                    $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            'useruimage' => $agentpic,
                            'userrole' => 1,
                            'vendor' => 0,
                            'block' => 0
                        ];
                } else if ($role == 2) //vendor
                {
                    $branchlogo = '';
                    $branchlogo = $this->request->getFile('branchlogo');
                    if ($branchlogo->isValid()) {
                          
    
                        $newName = $branchlogo->getRandomName();
                        $branchlogo->move('uploads/users', $newName);
                        $branchlogo = $newName;
                        

                    }

                    $refered_to=[];
                    if($this->request->getPost('subvendor')){
                        $refered_to=$this->request->getPost('subvendor');
                        $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            'useruimage' => $agentpic,
                            'vendor' => 0,
                            'smtpemail' => $this->request->getPost('smtpemail'),
                            'smtppassword' => $this->request->getPost('smtppassword'),
                            'smtpincomingserver' => $this->request->getPost('smtpincomingserver'),
                            'smtpoutgoingserver' => $this->request->getPost('smtpoutgoingserver'),
                            'smtpport' => $this->request->getPost('smtpport'),
                            'branchname' => $this->request->getPost('branchname'),
                            'branchslug' => $this->request->getPost('branchslug'),
                            'branchcountry' => $this->request->getPost('branchcountry'),
                            'branchaddress' => $this->request->getPost('branchaddress'),
                            'brancheader' => $this->request->getPost('brancheader'),
                            'branchnavbar' => $this->request->getPost('branchnavbar'),
                            'branchnavtext' => $this->request->getPost('branchnavtext'),
                            'branchnavhover' => $this->request->getPost('branchnavhover'),
                            'branchlogo' => $branchlogo,
                            'branchlogoheight' => $this->request->getPost('branchlogoheight'),
                            'branchlogowidth' => $this->request->getPost('branchlogowidth'),
                            'userrole' => 2,
                            'block' => 0,
                            'referred_to' => implode(', ', $this->request->getPost('subvendor')),
                        ];
                    }
                    else{

                    $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            'useruimage' => $agentpic,
                            'vendor' => 0,
                            'smtpemail' => $this->request->getPost('smtpemail'),
                            'smtppassword' => $this->request->getPost('smtppassword'),
                            'smtpincomingserver' => $this->request->getPost('smtpincomingserver'),
                            'smtpoutgoingserver' => $this->request->getPost('smtpoutgoingserver'),
                            'smtpport' => $this->request->getPost('smtpport'),
                            'branchname' => $this->request->getPost('branchname'),
                            'branchslug' => $this->request->getPost('branchslug'),
                            'branchcountry' => $this->request->getPost('branchcountry'),
                            'branchaddress' => $this->request->getPost('branchaddress'),
                            'brancheader' => $this->request->getPost('brancheader'),
                            'branchnavbar' => $this->request->getPost('branchnavbar'),
                            'branchnavtext' => $this->request->getPost('branchnavtext'),
                            'branchnavhover' => $this->request->getPost('branchnavhover'),
                            'branchlogo' => $branchlogo,
                            'branchlogoheight' => $this->request->getPost('branchlogoheight'),
                            'branchlogowidth' => $this->request->getPost('branchlogowidth'),
                            'userrole' => 2,
                            'block' => 0,
                            // 'referred_to' => implode(', ', $this->request->getPost('subvendor')),
                            'referred_to' => ""
                        ];
                    }
                } else if ($role == 3) //client
                {
                    $idata =
                        [
                            'firstname' => $this->request->getPost('firstname'),
                            'lastname' => $this->request->getPost('lastname'),
                            'email' => $email,
                            'password' => $password,
                            'phone' => $this->request->getPost('phone'),
                            'address' => $this->request->getPost('address'),
                            'website' => $this->request->getPost('website'),
                            'coverage' => $this->request->getPost('coverage'),
                            'linkedin' => $this->request->getPost('linkedin'),
                            'useruimage' => $agentpic,
                            'userrole' => 3,
                            'vendor' => implode(', ', $this->request->getPost('vendor')),
                            'block' => 0
                        ];
                }

                $save = $this->auth_model->insert($idata);
                $insert_id = $this->auth_model->insertID();
                if ($save) {
                    $session->setFlashdata('success', 'Your Account has been register sucessfully. ');

                    $notification_data = [
                        'description' => 'New Account has been created',
                        'to_user_id' => $insert_id,
                        'link' => base_url(),
                    ];
                    add_notification($notification_data);
                    return redirect()->to('allUsers');
                } else {
                    $session->setFlashdata('error', 'Failed to perform request.');
                    return redirect()->to('allUsers');
                }
            }


        }
        $data['session'] = $session;

        return view('user-register', $data);
    }

    public function deleteUser($id)
    {
        $model = new Auth_Model();
        log_activity('User Deleted [Full Name: ' . get_user_fullname($id) . ']');
        $model->deleteUser($id);
        return redirect()->to('/allUsers');
    }

    public function blockUser($id, $block)
    {
        $session = session();
        if ($block == 1) {
            $update = $this->auth_model->update($id, ['block' => 1]);
        } else {
            $update = $this->auth_model->update($id, ['block' => 0]);
        }

        if ($update) {
            $session->setFlashdata('error', 'Account Blocked');
        } else {
            $session->setFlashdata('success', 'Account Unblocked');
        }
        return redirect()->to('/allUsers');
    }

    public function editUser($id)
    {
        $data = [];
        $data['page_title'] = "Edit User";

        $data['data'] = $this->request;
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Edit User']),
            'page_title' => view('partials/page-title', ['title' => 'Edit User', 'pagetitle' => 'Home'])
        ];
        $data['vendors'] = $this->auth_model->select('id,firstname,lastname')->where('userrole', 2)->findAll();

        $session = session();
        if ($this->request->getMethod() == 'post') {
            $duser = $this->auth_model->where('id', $id)->findAll();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $role = $this->request->getPost('role');

            $agentpic = '';
            if ($agentpic = $this->request->getFile('agentpicture')->isValid()) {

                $input = $this->validate([
                    'agentpicture' => 'uploaded[agentpicture]|max_size[agentpicture,1024]|ext_in[agentpicture,jpg,jpeg,png],',


                ]);


                if (!$input) {
                    $agentpic = $duser[0]['useruimage'];
                    //$session->setFlashdata('error','Agent Picture not found.');
                } else {

                    $newName = $agentpic->getRandomName();
                    $agentpic->move('uploads/users', $newName);
                    $agentpic = $newName;

                    if (is_file('uploads/users/' . $duser[0]['useruimage'])) {
                        unlink('uploads/users/' . $duser[0]['useruimage']);
                    }
                }

            }
            if ($role == 1) //admin
            {
                $idata =
                    [
                        'firstname' => $this->request->getPost('firstname'),
                        'lastname' => $this->request->getPost('lastname'),
                        'email' => $email,
                        'password' => $password,
                        'phone' => $this->request->getPost('phone'),
                        'address' => $this->request->getPost('address'),
                        'website' => $this->request->getPost('website'),
                        'coverage' => $this->request->getPost('coverage'),
                        'linkedin' => $this->request->getPost('linkedin'),
                        'useruimage' => $agentpic,
                        'userrole' => 1,
                        'vendor' => 0,
                        'block' => 0
                    ];
            } else if ($role == 2) //vendor
            {
                $branchlogopic = '';
                if ($branchlogopic = $this->request->getFile('branchlogo')) {

                    /* $input2 = $this->validate([
                      'branchlogo' => 'uploaded[branchlogo]|max_size[branchlogo,1024]|ext_in[branchlogo,jpg,jpeg,png],'
                      ]);
                     
                     if (!$input2) 
                     { 
                        $branchlogopic = $duser[0]['branchlogo'];

                     }else{ */

                    $newNamebranch = $branchlogopic->getRandomName();
                    $branchlogopic->move('uploads/users', $newNamebranch);
                    $branchlogopic = $newNamebranch;

                    if (is_file('uploads/users/' . $duser[0]['branchlogo'])) {
                        unlink('uploads/users/' . $duser[0]['branchlogo']);
                    }
                    // }

                }
                $idata =
                    [
                        'firstname' => $this->request->getPost('firstname'),
                        'lastname' => $this->request->getPost('lastname'),
                        'email' => $email,
                        'password' => $password,
                        'phone' => $this->request->getPost('phone'),
                        'address' => $this->request->getPost('address'),
                        'website' => $this->request->getPost('website'),
                        'coverage' => $this->request->getPost('coverage'),
                        'linkedin' => $this->request->getPost('linkedin'),
                        'useruimage' => $agentpic,
                        'vendor' => 0,
                        'smtpemail' => $this->request->getPost('smtpemail'),
                        'smtppassword' => $this->request->getPost('smtppassword'),
                        'smtpincomingserver' => $this->request->getPost('smtpincomingserver'),
                        'smtpoutgoingserver' => $this->request->getPost('smtpoutgoingserver'),
                        'smtpport' => $this->request->getPost('smtpport'),
                        'branchname' => $this->request->getPost('branchname'),
                        'branchslug' => $this->request->getPost('branchslug'),
                        'branchcountry' => $this->request->getPost('branchcountry'),
                        'branchaddress' => $this->request->getPost('branchaddress'),
                        'brancheader' => $this->request->getPost('brancheader'),
                        'branchnavbar' => $this->request->getPost('branchnavbar'),
                        'branchnavtext' => $this->request->getPost('branchnavtext'),
                        'branchnavhover' => $this->request->getPost('branchnavhover'),
                        'branchlogo' => $branchlogopic,
                        'branchlogoheight' => $this->request->getPost('branchlogoheight'),
                        'branchlogowidth' => $this->request->getPost('branchlogowidth'),
                        'userrole' => 2,
                        'block' => 0,
                        'referred_to' => implode(', ', $this->request->getPost('subvendor')),
                    ];
            } else if ($role == 3) //client
            {
                $idata =
                    [
                        'firstname' => $this->request->getPost('firstname'),
                        'lastname' => $this->request->getPost('lastname'),
                        'email' => $email,
                        'password' => $password,
                        'phone' => $this->request->getPost('phone'),
                        'address' => $this->request->getPost('address'),
                        'website' => $this->request->getPost('website'),
                        'coverage' => $this->request->getPost('coverage'),
                        'linkedin' => $this->request->getPost('linkedin'),
                        'useruimage' => $agentpic,
                        'userrole' => 3,
                        'vendor' => implode(', ', $this->request->getPost('vendor')),
                        'block' => 0
                    ];
            }

            $update = $this->auth_model->update($id, $idata);

            if ($update) {
                $session->setFlashdata('success', 'Your Account has been updated sucessfully.');
                log_activity('Update user account [email: ' . $idata['email'] . ', Role:' . get_user_role($idata['userrole']) . ']');
                return redirect()->to('allUsers');
            } else {
                $session->setFlashdata('error', 'Failed to update data.');
            }
        }
        $data['duser'] = $this->auth_model->where('id', $id)->findAll();

        $data['session'] = $session;
        return view('user-edit', $data);
    }


    public function update_user()
    {
        $session = session();
        if ($this->request->getMethod() == 'post') {
            extract($this->request->getPost());
            $verify_password = password_verify($current_password, $session->login_password);
            if ($password !== $cpassword) {
                $session->setFlashdata('error', "Password does not match.");
            } elseif (!$verify_password) {
                $session->setFlashdata('error', "Current Password is Incorrect.");
            } else {
                $udata = [];
                $udata['name'] = $name;
                $udata['email'] = $email;
                if (!empty($password))
                    $udata['password'] = password_hash($password, PASSWORD_DEFAULT);
                $update = $this->auth_model->where('id', $session->login_id)->set($udata)->update();
                if ($update) {
                    $session->setFlashdata('success', "Your Account has been updated successfully.");
                    $user = $this->auth_model->where("id ='{$session->login_id}'")->first();
                    foreach ($user as $k => $v) {
                        $session->set('login_' . $k, $v);
                    }
                    return redirect()->to('update_user');
                } else {
                    $session->setFlashdata('error', "Your Account has failed to update.");
                }
            }
        }

        // $this->data['session'] = $session;
        // $this->data['page_title'] = "Users";
        // $this->data['user'] = $this->auth_model->where("id ='{$session->login_id}'")->first();
        // return view('pages/users/update_account', $this->data);
    }

    public function recoverpassword()
    {

        $data = [];
        $data['page_title'] = "Recover Password";
        $session = session();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $validate = $this->auth_model->where('email', $this->request->getPost('email'))->first();
                if ($validate) {
                    $result = send_password_reset_email($validate['email'], $validate['password']);
                    if ($result) {
                        $session->setFlashdata('success', 'Password is sent to the given Email.');
                    } else {
                        $session->setFlashdata('error', 'Email settings are not configured.');
                    }
                    /* $password_detail = $this->login_model->get_password_by_email($this->input->post("email"));
                     foreach ($password_detail as $p_d)
                     {
                       $password = $p_d["userpassword"];
                     }
                     $this->load->library('email');
                     $config['protocol']='smtp';
                     $config['smtp_host']='ssl://mail.ttmg.biz';
                     $config['smtp_port']=465;
                     $config['smtp_user']='admin@ttmg.biz';
                     $config['smtp_pass']='2n4)},f{VH{b';
                     $config['charset']='utf-8';
                     $config['newline']='/r/n';
                     $config['mailtype']='html';
                     $config['validation']=TRUE;
                     $this->email->initialize($config);
                     $this->email->from('admin@ttmg.biz','LeadGenerationCRM');
                     $this->email->to(''.$this->input->post("email").'');
                     $this->email->subject('Forget Password');
                     $this->email->message('<p>Here is your password</p>
                       <p><b>'.$password.'</b></p>
                               
                     ');
                     $this->email->send();*/
                    //var_dump($validate['email']);


                    //return redirect()->to('/otp');
                } else {
                    $session->setFlashdata('error', 'There is no user with this Email.');
                    //return redirect()->to('/recover-password');
                }
            } else {
                $session->setFlashdata('error', 'Please provide an email.');
                //return redirect()->to('/recover-password');
            }
        }

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Recover Password'])
        ];
        $data['session'] = $session;
        return view('auth-recoverpw', $data);
    }

    public function getUserId($id)
    {
        $duser = $this->auth_model->where('id', $id)->findAll();
        $html = '<table class="table table-bordered">';
        $html .= '<tr><td>First Name</td><td>' . $duser[0]['firstname'] . '</td></tr>';
        $html .= '<tr><td>Last Name</td><td>' . $duser[0]['lastname'] . '</td></tr>';
        $html .= '<tr><td>Email</td><td>' . $duser[0]['email'] . '</td></tr>';
        $html .= '<tr><td>Password</td><td>' . $duser[0]['password'] . '</td></tr>';
        $html .= '<tr><td>Phone</td><td>' . $duser[0]['phone'] . '</td></tr>';
        $html .= '<tr><td>Address</td><td>' . $duser[0]['address'] . '</td></tr>';
        $html .= '<tr><td>Website</td><td>' . $duser[0]['website'] . '</td></tr>';
        $html .= '<tr><td>Coverage Area</td><td>' . $duser[0]['coverage'] . '</td></tr>';
        $html .= '<tr><td>Linkedin</td><td>' . $duser[0]['linkedin'] . '</td></tr>';
        if ($duser[0]['userrole'] == 1) {
            $html .= '<tr><td>Role</td><td><span class="badge bg-primary">Admin</span></td></tr>';
        } elseif ($duser[0]['userrole'] == 2) {
            $html .= '<tr><td>Role</td><td><span class="badge bg-success">Vendor</span></tr>';
            $html .= '<tr><td>SMTP Email</td><td>' . $duser[0]['smtpemail'] . '</td></tr>';
            $html .= '<tr><td>SMTP Password</td><td>' . $duser[0]['smtppassword'] . '</td></tr>';
            $html .= '<tr><td>SMTP Incoming</td><td>' . $duser[0]['smtpincomingserver'] . '</td></tr>';
            $html .= '<tr><td>SMTP Outgoing</td><td>' . $duser[0]['smtpoutgoingserver'] . '</td></tr>';
            $html .= '<tr><td>SMTP Port</td><td>' . $duser[0]['smtpport'] . '</td></tr>';

            $html .= '<tr><td>Branch Name</td><td>' . $duser[0]['branchname'] . '</td></tr>';
            $html .= '<tr><td>Branch Slug</td><td>' . $duser[0]['branchslug'] . '</td></tr>';
            $html .= '<tr><td>Branch Country</td><td>' . $duser[0]['branchcountry'] . '</td></tr>';
            $html .= '<tr><td>Branch Address</td><td>' . $duser[0]['branchaddress'] . '</td></tr>';
            $html .= '<tr><td>Header Color</td><td>' . $duser[0]['brancheader'] . '</td></tr>';
            $html .= '<tr><td>Navbar Color</td><td>' . $duser[0]['branchnavbar'] . '</td></tr>';
            $html .= '<tr><td>Navbar Text Color </td><td>' . $duser[0]['branchnavtext'] . '</td></tr>';
            $html .= '<tr><td>Text Hover Color </td><td>' . $duser[0]['branchnavhover'] . '</td></tr>';
        } elseif ($duser[0]['userrole'] == 3) {
            $html .= '<tr><td>Password</td><td><span class="badge bg-info">Client</span></tr>';
        }


        $html .= '</table>';

        echo $html;

    }

    public function getAllUsers()
    {
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'All Users']),
            'page_title' => view('partials/page-title', ['title' => 'All Users', 'pagetitle' => 'Home'])

        ];
        return view('user-management', $data);
    }

    public function ajaxAllUsers()
    {
        $db = db_connect();
        $builder = $db->table('ttmg_users')
            ->select('id,useruimage,firstname, lastname, email,password,userrole,branchslug,block')
            ->where('userrole !=', 1);

        return DataTable::of($builder)
            ->edit('userrole', function ($row) {
                $userrole = '';
                if ($row->userrole == 1) {
                    $userrole = '<span class="badge bg-primary">Admin</span>';
                } else if ($row->userrole == 2) {
                    $userrole = '<span class="badge bg-success">Vendor</span>';
                } else {
                    $userrole = '<span class="badge bg-info">Client</span>';
                }
                return $userrole;
            })
            ->edit('useruimage', function ($row) {
                $aimg = '';
                if ($row->useruimage) {
                    $aimg = '<img src="' . base_url("uploads/users/") . $row->useruimage . '" width="50" height="50" />';
                }
                return $aimg;
            })
            ->edit('branchslug', function ($row) {
                return '<a href="#">' . base_url('login/') . $row->branchslug . '</a>';
            })
            ->edit('block', function ($row) {

                if ($row->block == 0) {
                    return '<span class="badge bg-success">Active</span>';
                } else {
                    return '<span class="badge bg-danger">Blocked</span>';
                }


            })
            ->add('Action', function ($row) {
                $block = 0;
                $drow = '<i class="uil uil-unlock-alt font-size-18"></i>';
                if ($row->block == 0) {
                    $block = 1;
                    $drow = '<i class="uil uil-lock font-size-18"></i>';
                }
                return '<a href="' . site_url('editUser/') . $row->id . '" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                <a href="' . base_url('deleteUser/') . $row->id . '" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                 <a href="' . base_url('blockUser/') . $row->id . '/' . $block . '" class="px-3 text-danger">' . $drow . '</a>';
            }, 'last')

            ->filter(function ($builder, $request) {

                if ($request->filter_role)
                    $builder->where('userrole', $request->filter_role);

            })
            ->toJson();
    }

    public function get_subvendors()
    {
        $sv = has_subvendors();
        echo json_encode($sv);
    }




    // API 
    public function login_api()
    {
        if ($this->request->getMethod() == 'post') {
            $user = $this->auth_model->where('email', $this->request->getPost('email'))->first();
            if ($user) {
                $verify_password = $this->auth_model->select('firstname,lastname,email,brancheader,branchnavbar')->where('password', $this->request->getPost('password'))->first();
                if ($verify_password) {
                    if ($user['block'] == 1) {
                        $status = "1";
                        $message = "Your Account is not yet validated.";
                    } elseif ($user['block'] == 2) {
                        $status = "2";
                        $message = "Your Account has been banned.'.";
                    } elseif ($user['block'] == 0) {
                        $message = "Logged In Sucessfully.";

                        helper('text');
                        $token = random_string('alnum', 16);
                        $this->auth_model->update($user['id'], ["token" => $token]);
                        $response['user_id']=$user['id'];
                        $response["data"]=$verify_password;
                        $response["token"]=$token;
                        $response["status"] =1;
                           
                        
                    }
                } else {
                    $message = "Incorrect Password.";
                    $response["status"] =0;

                }
            } else {
                $message = "Incorrect Email or Password";
                $response["status"] =0;

            }
            $response["message"]=$message;
           echo json_encode( $response);
        }
    }


    public function get_agents(){
       $agents= $this->lead_master_model->select('agent_name')->findAll();
        echo json_encode($agents);
    }


}
