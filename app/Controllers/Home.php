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
		$clients=$this->auth_model->where('userrole',3)->findAll();
		$lead_count=$this->lead_model->where('userrole',3)->countAll();




		$data['orders']=$orders;
		$data['vendors']=$vendors;
		$data['clients']=$clients;
		$data['lead_count']=$lead_count;

		$data['activities'] = $this->activity_model->orderBy('id','desc')->limit(10)->get()->getResultArray();
		return view('index', $data);
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