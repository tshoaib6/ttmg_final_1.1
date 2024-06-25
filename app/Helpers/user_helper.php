<?php

function get_client($id="",$vendor_id="")
{
    $db = \Config\Database::connect();
    $builder = $db->table('users');
    $builder->select('id,firstname,lastname,email');
    if($id!=''){
        $builder->where('userrole', 3)->where('block', 0)->where('id',$id);
    }elseif($vendor_id!=""){
        $builder->where('userrole', 3)->where('block', 0)->where('vendor',$vendor_id);

    }
    else{
        $builder->where('userrole', 3)->where('block', 0);
    }
    $users = $builder->get()->getResultArray();

    return $users;
}

function get_vendors($id='')
{
    $db = \Config\Database::connect();
    $builder = $db->table('users');
    $builder->select('id,firstname,lastname,email');
    if($id!=''){
        $builder->where('userrole', 2)->where('block', 0)->where('id',$id);

    }
    else{
        $builder->where('userrole', 2)->where('block', 0);
    }
    $users = $builder->get()->getResultArray();

    return $users;
}

function get_campaign_columns($camp_id){
    $db = \Config\Database::connect();
    $builder = $db->table('campaign');
    $builder->where('id', $camp_id);
    $builder->select('id,campaign_name,campaign_columns');
    $camp =  $builder->get()->getResultArray();
    return json_encode($camp);
}

function vendor_smtp($id){
    $db = \Config\Database::connect();
    $builder = $db->table('users');
    $builder->select('smtpemail,smtppassword,smtpincomingserver,smtpoutgoingserver,smtpport');
    $builder->where('userrole', 2)->where('block', 0)->where('id',$id);
    $users = $builder->get()->getResultArray();
    return $users[0];
}

function has_subvendors(){
    $sub_vendors = [];

    $db = \Config\Database::connect();
    $builder = $db->table('users');
    $builder->select('referred_to');
    $builder->where('userrole', 2)->where('block', 0)->where('id', get_user_id());
    $sub_vendors_ids = $builder->get()->getResultArray();

    if (!empty($sub_vendors_ids) && !empty($sub_vendors_ids[0]['referred_to'])) {
        $sub_vendors_ids = explode(",", $sub_vendors_ids[0]['referred_to']);
        foreach ($sub_vendors_ids as $sv) {
            $builder->select('id, firstname, lastname');
            $builder->where('userrole', 2)->where('block', 0)->where('id', $sv);
            $temp_sub_vendors = $builder->get()->getResultArray();
            if (!empty($temp_sub_vendors)) {
                array_push($sub_vendors, $temp_sub_vendors[0]);
            }
        }
    }

    return $sub_vendors;
}
