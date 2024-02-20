<?php 
namespace App\Controllers;
use App\Models\Auth;
use App\Models\ActivityLog as Activity;
use App\Models\Lead;
use App\Models\Order;


class Home extends BaseController
{	
	protected $request;
	protected $activity_model;

	protected $order_model;
	protected $lead_model;

	
	public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->auth_model = new Auth;
        $this->lead_model = new Lead;

        $this->activity_model = new Activity;
		$this->order_model=new Order;
        $this->data = ['session' => $this->session];
    }

	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Home'])
		];
		$orders=$this->order_model->findAll(); 
		$vendors=$this->auth_model->where('userrole',2)->findAll();
		if(is_vendor()){
			$clients=get_client("",get_user_id());
		}
		else{
			$clients=$this->auth_model->where('userrole',3)->findAll();
		}
		$lead_count=$this->lead_model->countAll();

		/* Chart data start*/

		$label_dates = '';
       	$current_year = date('Y');
		for($_month = 1 ; $_month <= 12; $_month++){
			$month_t = date('m-d-Y',mktime(0, 0, 0, $_month, 01, $current_year));

		$label_dates .= "'".$month_t."',";
				
		}
		$data['label_dates'] = rtrim($label_dates, ',');

		for($lead_month = 1 ; $lead_month <= 12; $lead_month++){
			$month_t = date('m-Y',mktime(0, 0, 0, $lead_month, 01, $current_year));

			if(is_admin())
			{
				$data['total_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->countAllResults();
				$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('status',1)->countAllResults();
				$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('status',2)->countAllResults();
			}	

			if(is_vendor())
			{
				$data['total_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id',get_user_id())->countAllResults();

				$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id',get_user_id())->where('status',1)->countAllResults();

				$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id',get_user_id())->where('status',2)->countAllResults();
			}

			if(is_client())
			{
				$data['total_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id',get_user_id())->countAllResults();

				$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id',get_user_id())->where('status',1)->countAllResults();
				
				$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id',get_user_id())->where('status',2)->countAllResults();
			}
		}

		$data['total_leads'] = implode(',', $data['total_leads']);	
		$data['total_accepted_leads'] = implode(',', $data['total_accepted_leads']);
		$data['total_rejected_leads'] = implode(',', $data['total_rejected_leads']);

		/* Chart data end*/


		$data['orders']=$orders;
		$data['vendors']=$vendors;
		$data['clients']=$clients;
		$data['lead_count']=$lead_count;

		$data['activities'] = $this->activity_model->orderBy('id','desc')->limit(10)->get()->getResultArray();
		return view('index', $data);
	}

	public function ajaxDashboardLeadChart($sort)
	{
		if($sort == 'yearly')
		{

		}else if($sort == 'monthly')
		{



		}else{

				$data['label_dates'] = 'Mon,Tue,Wed,Thu,Fri,Sat';
		}
	}

	public function show_layouts_horizontal(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-horizontal', $data);
	}

	public function show_layouts_vertical(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Vertical Layout']),
			'page_title' => view('partials/page-title', ['title' => 'Vertical', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-vertical', $data);
	}

	public function show_layouts_dark_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dark Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Dark Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-dark-sidebar', $data);
	}

	public function show_layouts_hori_topbar_dark(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dark Topbar']),
			'page_title' => view('partials/page-title', ['title' => 'Dark Topbar', 'pagetitle' => 'Horizontal'])
		];
		return view('layouts-hori-topbar-dark', $data);
	}

	public function show_layouts_hori_boxed_width(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed Width']),
			'page_title' => view('partials/page-title', ['title' => 'Boxed Width', 'pagetitle' => 'Horizontal'])
		];
		return view('layouts-hori-boxed-width', $data);
	}

	public function show_layouts_hori_preloader(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Preloader', 'pagetitle' => 'Horizontal'])
		];
		return view('layouts-hori-preloader', $data);
	}

	public function show_layouts_compact_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Compact Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Compact Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-compact-sidebar', $data);
	}

	public function show_layouts_icon_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Icon Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Icon Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-icon-sidebar', $data);
	}

	public function show_layouts_boxed(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed Width']),
			'page_title' => view('partials/page-title', ['title' => 'Boxed Width', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-boxed', $data);
	}

	public function show_layouts_preloader(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Preloader', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-preloader', $data);
	}

	public function show_layouts_colored_sidebar(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colored Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Colored Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-colored-sidebar', $data);
	}

	public function show_index_dark(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Dashboard'])
		];
		return view('index-dark', $data);
	}

	public function show_index_rtl(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Dashboard'])
		];
		return view('index-rtl', $data);
	}


	public function show_layouts_horizontal_dark(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-horizontal-dark', $data);
	}
	
	public function show_layouts_horizontal_rtl(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-horizontal-rtl', $data);
	}

}