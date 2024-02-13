<?php

/**
 *   Email functions -> Start 
 */

if (!function_exists('send_password_reset_email')) {
    /**
     * Builds a password reset HTML email from views and sends it.
     */
    function send_password_reset_email($to, $password)
    {
        $htmlMessage = view('emails\header');
        $htmlMessage .= '<p>Here is your password</p>
                  <p><b>' . $password . '</b></p>'; //view('emails\reset', ['hash' => $resetHash]);
        $htmlMessage .= view('emails\footer');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.ttmg.biz',
            'smtp_port' => 587,
            'smtp_user' => 'admin@ttmg.biz',
            'smtp_pass' => '2n4)},f{VH{b',
            'charset' => 'utf-8',
            'validation' => TRUE,
        ]);

        $email->setTo($to);
        $email->setSubject('Password reset request');
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}


if (!function_exists('send_referral_email')) {
    /**
     * Builds a password reset HTML email from views and sends it.
     */
    function send_referral_email($to, $client_name, $vendor_name, $link)
    {
        $htmlMessage = view('emails\header');
        $htmlMessage .= '<p>Hi ' . $client_name . ',</p>
                         <p>Please register on our lead generation platform by using this link: <a href="' . $link . '">Click Here</a></p>
                         <p>Note: It is only one time link make sure you register properly.</p>';
        $htmlMessage .= view('emails\footer');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.ttmg.biz',
            'smtp_port' => 587,
            'smtp_user' => 'admin@ttmg.biz',
            'smtp_pass' => '2n4)},f{VH{b',
            'charset' => 'utf-8',
            'validation' => TRUE,
        ]);

        $email->setTo($to);
        $email->setSubject('Referral Registeration form ' . $vendor_name);
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}

function send_email($to, $event)
{
    $db = \Config\Database::connect();
    $builder = $db->table('emailtemplate')->select('subject,message');
    $email_template = $builder->where('event', $event)->get()->getResultArray();

    $htmlMessage = view('emails\header');
    $htmlMessage .= view('emails\body', ['message' => $email_template[0]['message']]);
    $htmlMessage .= view('emails\footer');

    $email = \Config\Services::email();
    $email->initialize([
        'mailType' => 'html',
        'protocol' => 'smtp',
        'smtp_host' => 'mail.ttmg.biz',
        'smtp_port' => 587,
        'smtp_user' => 'admin@ttmg.biz',
        'smtp_pass' => '2n4)},f{VH{b',
        'charset' => 'utf-8',
        'validation' => TRUE,
    ]);

    $email->setTo($to);
    $email->setSubject($email_template[0]['subject']);
    $email->setMessage($htmlMessage);

    return $email->send();
}



/**
 *   Email functions -> End 
 *   Options Table Handler -> Start
 */
function add_option($name, $value = '')
{
    if (!option_exists($name)) {

        $db = \Config\Database::connect();
        $builder = $db->table('options');
        $newData = [
            'name' => $name,
            'value' => $value,
        ];

        $output = $builder->insert($newData);

        if ($output) {
            return true;
        }
    }

    return false;
}

function update_option($name, $value)
{
    /**
     * Create the option if not exists
     * @since  2.3.3
     */
    if (!option_exists($name)) {
        return add_option($name, $value);
    }

    $db = \Config\Database::connect();
    $builder = $db->table('options');

    $builder->where('name', $name);
    $data = ['value' => $value];

    return $builder->update($data);
}

function get_option($name)
{
    $db = \Config\Database::connect();
    $builder = $db->table('options');

    $name = trim($name);
    $data = $builder->where('name', $name)
        ->get();
    foreach ($data->getResult() as $row) {
        return $row->value;
    }
}


function option_exists($name)
{
    $db = \Config\Database::connect();
    $builder = $db->table('options');

    $count = $builder->where('name', $name)
        ->countAll();
    return $count;
}

function delete_option($name)
{
    $db = \Config\Database::connect();
    $builder = $db->table('options');

    $builder->where('name', $name);

    return (bool) $builder->delete();
}
/**
 * 
 *   Options Table Handler -> End
 *   Random Funtions -> Start
 */

if (!function_exists('customDateFormatter')) {
    function customDateFormatter($oldDate)
    {
        $newDate = date("m-d-Y", strtotime($oldDate));
        return $newDate;
    }
}

function url_clean($string)
{
    $string = str_replace('%20', ' ', $string);

    return $string;
}

function get_user_id()
{
    if (session()->has('login_id') == 1) {
        return session()->login_id;
    }
    return false;
}

function is_admin()
{
    if (session()->has('login_userrole') == 1) {
        if (session()->login_userrole == 1) {
            return true;
        }

    }
    return false;
}
function is_vendor()
{
    if (session()->has('login_userrole') == 1) {
        if (session()->login_userrole == 2) {
            return true;
        }
    }
    return false;
}
function is_client()
{
    if (session()->has('login_userrole') == 1) {
        if (session()->login_userrole == 3) {
            return true;
        }
    }
    return false;
}

function get_user_fullname($uid = null)
{
    if ($uid == null) {
        return session()->login_firstname . ' ' . session()->login_lastname;
    } else {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $builder->where('id', $uid);
        $query = $builder->get();

        foreach ($query->getResult() as $row) {
            return $row->firstname . ' ' . $row->lastname;
        }

    }
}

function get_user_data($uid)
{
    $db = \Config\Database::connect();
    $builder = $db->table('users');

    $builder->where('id', $uid);
    $query = $builder->get();

    return $query->getResult();

}

function get_user_image($uid)
{
    $image = '';
    $db = \Config\Database::connect();
    $builder = $db->table('users');

    $builder->where('id', $uid);
    $query = $builder->get();

    foreach ($query->getResult() as $row) {
        $image = $row->useruimage;
    }

    if (empty($image) || is_null($image)) {
        return 'ttmg-default.png';
    } else {
        return $image;
    }

}

function get_user_role($rid)
{
    if ($rid == 1) {
        return 'Admin';

    } else if ($rid == 2) {
        return 'Vendor';
    } elseif ($rid == 3) {
        return 'Client';
    } else {
        return 'No Role Found!';
    }

}

function time_ago($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
/**
 * 
 *   Random Funtions -> End
 *   Notification Functions -> Start
 */

function add_notification($data)
{
    $data['isread'] = 0;
    $data['from_user_id'] = session()->login_id;
    $data['from_full_name'] = session()->login_firstname . ' ' . session()->login_lastname;

    $db = \Config\Database::connect();
    $builder = $db->table('notifications');

    if (is_array($data['to_user_id']) == 1) {
        $to_array = $data['to_user_id'];
        foreach ($to_array as $v) {
            $data['to_user_id'] = $v;
            $builder->insert($data);
        }
    } else {

        $builder->insert($data);
    }


    return true;
}

/**
 * 
 *   Notification Functions -> End
 *   Activity Log Function -> Start
 */

function log_activity($description, $userid = null)
{
    $db = \Config\Database::connect();
    $builder = $db->table('activitylog');

    $full_name = '';
    if ($userid == null) {
        $userid = get_user_id();
        $full_name = get_user_fullname();

    } else {
        $full_name = get_user_fullname($userid);
    }

    $data = [
        'description' => $description,
        'user_id' => $userid,
        'full_name' => $full_name,
    ];

    $builder->insert($data);
    return true;
}

function get_email_by_user_id($user_id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('users')->select('email');
    $user = $builder->where('id', $user_id)->get()->getResultArray();
    return $user[0]['email'];
}

function generateStateSelect()
{
    $states = array(
        "AK" => "Alaska",
        "AL" => "Alabama",
        "AR" => "Arkansas",
        "AZ" => "Arizona",
        "CA" => "California",
        "CO" => "Colorado",
        "CT" => "Connecticut",
        "DC" => "District of Columbia",
        "DE" => "Delaware",
        "FL" => "Florida",
        "GA" => "Georgia",
        "HI" => "Hawaii",
        "IA" => "Iowa",
        "ID" => "Idaho",
        "IL" => "Illinois",
        "IN" => "Indiana",
        "KS" => "Kansas",
        "KY" => "Kentucky",
        "LA" => "Louisiana",
        "MA" => "Massachusetts",
        "MD" => "Maryland",
        "ME" => "Maine",
        "MI" => "Michigan",
        "MN" => "Minnesota",
        "MO" => "Missouri",
        "MS" => "Mississippi",
        "MT" => "Montana",
        "NC" => "North Carolina",
        "ND" => "North Dakota",
        "NE" => "Nebraska",
        "NH" => "New Hampshire",
        "NJ" => "New Jersey",
        "NM" => "New Mexico"
    );

    $selectHTML = '<div class="col-sm-6 mb-3">';
    $selectHTML .= '<label class="form-label" for="formrow-campaign-input">State<span class="required"> * </span></label>';
    $selectHTML .= '<select class="form-control select2" name="state" style="width: 100%;">';

    foreach ($states as $abbreviation => $name) {
        $selectHTML .= '<option value="' . $abbreviation . '">' . $name . '</option>';
    }

    $selectHTML .= '</select>';
    $selectHTML .= '</div>';

    return $selectHTML;
}

function get_categories(){
    $db = \Config\Database::connect();
    $builder = $db->table('campaign')->select('id,campaign_name');
    $camp = $builder->get()->getResultArray();
    return $camp;
}