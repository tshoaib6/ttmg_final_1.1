<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'pkorderid';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];




    public function update_order($lead_count, $order_id)
    {
        $existingRemainingLeads = $this->where('pkorderid', $order_id)->get()->getRow()->remainingLeads;
        $remainingLeads = max(0, $existingRemainingLeads - $lead_count);
        $this->set('remainingLeads', $remainingLeads)
            ->where('pkorderid', $order_id)
            ->update();
        if ($remainingLeads == 0 || $remainingLeads <0) {
            $this->set('status', 3)
                ->where('pkorderid', $order_id)
                ->update();
        }
        return $remainingLeads;
    }

    public function holdorder($order_id)
    {
        $this->set('status', 3)
            ->where('pkorderid', $order_id)
            ->update();

    }

    public function get_campain_col_by_order_id($order_id)
    {
        $camp_id = $this->where('pkorderid', $order_id)->get()->getRow()->categoryname;
        $builder = $this->db->table('campaign');
        $builder->where('id', $camp_id);
        $camp_col = $builder->get()->getRow()->campaign_columns;
        return json_decode($camp_col);
    }

    public function get_camp_headers($order_id="",$camp_id="")
    {
        if($order_id!=""){
            $camp_id = $this->where('pkorderid', $order_id)->get()->getRow()->categoryname;
        }
        $builder = $this->db->table('campaign');
        $builder->where('id', $camp_id);
        $camp_col = $builder->get()->getRow()->campaign_columns;
        $camp_col = json_decode($camp_col);
        $colSlugs = array();
        foreach ($camp_col as $item) {
            $colSlugs[] = $item->col_slug;
        }

        return $colSlugs;

    }
}
