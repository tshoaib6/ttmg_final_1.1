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