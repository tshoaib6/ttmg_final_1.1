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

	protected $session;

	public function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = session();
		$this->auth_model = new Auth;
		$this->lead_model = new Lead;
		$this->session = session();
		$this->activity_model = new Activity;
		$this->order_model = new Order;
		$this->data = ['session' => $this->session];
	}

	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Home'])
		];
		$orders = $this->order_model->findAll();
		$vendors = $this->auth_model->where('userrole', 2)->findAll();
		if (is_vendor()) {
			$clients = get_client("", get_user_id());
		} else {
			$clients = $this->auth_model->where('userrole', 3)->findAll();
		}
		$lead_count = $this->lead_model->countAll();
		$label_dates = '';
		$current_year = date('Y');
		$leads_count = 0;
		$total_leads = 0;
		for ($_month = 1; $_month <= 12; $_month++) {
			$month_t = date('m-d-Y', mktime(0, 0, 0, $_month, 01, $current_year));
			$label_dates .= "'" . $month_t . "',";
		}
		$data['label_dates'] = rtrim($label_dates, ',');

		for ($lead_month = 1; $lead_month <= 12; $lead_month++) {
			$month_t = date('m-Y', mktime(0, 0, 0, $lead_month, 01, $current_year));
			if (is_admin()) {
				$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->countAllResults();
				$total_leads += $leads_count;
				$data['total_leads'][] = $leads_count;
				$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('status', 1)->countAllResults();
				$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('status', 2)->countAllResults();
			}

			if (is_vendor()) {
				$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id', get_user_id())->countAllResults();
				$total_leads += $leads_count;
				$data['total_leads'][] = $leads_count;
				$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 1)->countAllResults();
				$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 2)->countAllResults();
			}

			if (is_client()) {
				$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id', get_user_id())->countAllResults();
				$total_leads += $leads_count;
				$data['total_leads'][] = $leads_count;

				$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 1)->countAllResults();

				$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 2)->countAllResults();
			}
		}

		$data['total_leads'] = implode(',', $data['total_leads']);
		$data['total_accepted_leads'] = implode(',', $data['total_accepted_leads']);
		$data['total_rejected_leads'] = implode(',', $data['total_rejected_leads']);
		$data['dash_total_leads'] = $total_leads;
		/* Chart data end*/


		$data['orders'] = $orders;
		$data['vendors'] = $vendors;
		$data['clients'] = $clients;
		$data['lead_count'] = $lead_count;

		$data['activities'] = $this->activity_model->orderBy('id', 'desc')->where('user_id',get_user_id())->limit(10)->get()->getResultArray();
		return view('index', $data);
	}

	public function ajaxDashboardLeadChart($sort)
	{
		$current_year = date('Y');
		$leads_count = 0;
		$total_leads = 0;
		if ($sort == 'yearly') {
			$label_dates = '';
			for ($_month = 1; $_month <= 12; $_month++) {
				$month_t = date('M-Y', mktime(0, 0, 0, $_month, 01, $current_year));

				$data['label_dates'][] = $month_t;

			}
			//$data['label_dates'] = rtrim($label_dates, ',');

			for ($lead_month = 1; $lead_month <= 12; $lead_month++) {
				$month_t = date('m-Y', mktime(0, 0, 0, $lead_month, 01, $current_year));

				if (is_admin()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;
					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('status', 1)->countAllResults();
					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('status', 2)->countAllResults();
				}

				if (is_vendor()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id', get_user_id())->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;

					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 1)->countAllResults();

					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 2)->countAllResults();
				}

				if (is_client()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id', get_user_id())->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;

					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 1)->countAllResults();

					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 2)->countAllResults();
				}
			}

		} else if ($sort == 'monthly') {
			$label_dates = '';
			$month_last_day = date('t');
			$current_month = date('m');

			for ($_month = 1; $_month <= $month_last_day; $_month++) {
				$month_t = date('m-d-Y', mktime(0, 0, 0, $current_month, $_month, $current_year));

				$data['label_dates'][] = $month_t;

			}
			//$data['label_dates'] = rtrim($label_dates, ',');

			for ($lead_month = 1; $lead_month <= $month_last_day; $lead_month++) {
				$month_t = date('d-m-Y', mktime(0, 0, 0, $current_month, $lead_month, $current_year));

				if (is_admin()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;
					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('status', 1)->countAllResults();
					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('status', 2)->countAllResults();
				}

				if (is_vendor()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('vendor_id', get_user_id())->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;

					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 1)->countAllResults();

					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 2)->countAllResults();
				}

				if (is_client()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('client_id', get_user_id())->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;

					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 1)->countAllResults();

					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%d-%m-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 2)->countAllResults();
				}
			}


		} else if ($sort == 'weekly') {

			$label_dates = '';
			$monday = date('d', strtotime('monday this week'));
			$sat = date('d', strtotime('saturday this week'));
			$current_month = date('m');

			for ($lead_days = $monday; $lead_days <= $sat; $lead_days++) {
				$month_t = date('d-D-Y', mktime(0, 0, 0, $current_month, $lead_days, $current_year));
				$data['label_dates'][] = $month_t;
			}

			for ($lead_month = $monday; $lead_month <= $sat; $lead_month++) {
				$month_t = date('m-d-Y', mktime(0, 0, 0, $current_month, $lead_month, $current_year));
				//$label_dates .= "'".$month_t."',";

				if (is_admin()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->countAllResults();
					$total_leads += $leads_count;

					$data['total_leads'][] = $leads_count;
					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('status', 1)->countAllResults();
					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('status', 2)->countAllResults();
				}

				if (is_vendor()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('vendor_id', get_user_id())->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;

					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 1)->countAllResults();

					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('vendor_id', get_user_id())->where('status', 2)->countAllResults();
				}

				if (is_client()) {
					$leads_count = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('client_id', get_user_id())->countAllResults();
					$total_leads += $leads_count;
					$data['total_leads'][] = $leads_count;

					$data['total_accepted_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 1)->countAllResults();

					$data['total_rejected_leads'][] = $this->lead_model->where("DATE_FORMAT(lead_date,'%m-%d-%Y')", $month_t)->where('client_id', get_user_id())->where('status', 2)->countAllResults();
				}
			}


		}
		$data['dash_total_leads'] = $total_leads;

		echo json_encode($data);
	}

	public function show_layouts_horizontal()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-horizontal', $data);
	}

	public function show_layouts_vertical()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Vertical Layout']),
			'page_title' => view('partials/page-title', ['title' => 'Vertical', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-vertical', $data);
	}

	public function show_layouts_dark_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dark Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Dark Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-dark-sidebar', $data);
	}

	public function show_layouts_hori_topbar_dark()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dark Topbar']),
			'page_title' => view('partials/page-title', ['title' => 'Dark Topbar', 'pagetitle' => 'Horizontal'])
		];
		return view('layouts-hori-topbar-dark', $data);
	}

	public function show_layouts_hori_boxed_width()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed Width']),
			'page_title' => view('partials/page-title', ['title' => 'Boxed Width', 'pagetitle' => 'Horizontal'])
		];
		return view('layouts-hori-boxed-width', $data);
	}

	public function show_layouts_hori_preloader()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Preloader', 'pagetitle' => 'Horizontal'])
		];
		return view('layouts-hori-preloader', $data);
	}

	public function show_layouts_compact_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Compact Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Compact Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-compact-sidebar', $data);
	}

	public function show_layouts_icon_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Icon Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Icon Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-icon-sidebar', $data);
	}

	public function show_layouts_boxed()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed Width']),
			'page_title' => view('partials/page-title', ['title' => 'Boxed Width', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-boxed', $data);
	}

	public function show_layouts_preloader()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Preloader', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-preloader', $data);
	}

	public function show_layouts_colored_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colored Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Colored Sidebar', 'pagetitle' => 'Vertical'])
		];
		return view('layouts-colored-sidebar', $data);
	}

	public function show_index_dark()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Dashboard'])
		];
		return view('index-dark', $data);
	}

	public function show_index_rtl()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Dashboard'])
		];
		return view('index-rtl', $data);
	}


	public function show_layouts_horizontal_dark()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-horizontal-dark', $data);
	}

	public function show_layouts_horizontal_rtl()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Horizontal', 'pagetitle' => 'Layouts'])
		];
		return view('layouts-horizontal-rtl', $data);
	}

}