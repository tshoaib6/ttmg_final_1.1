<!-- Bootstrap Css -->
<link href="<?=base_url('assets/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?=base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?=base_url('assets/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css" />
<!-- Notification Css-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/toastr/build/toastr.min.css'); ?>">

<?php 

    $company_color_code = json_decode(get_option('companysettings'),1);
	$headercolor = $company_color_code['headercolor'];//'#5b73e8';
	$login_bg = $company_color_code['login_bg']; //'#5b8ce847';
	$navbar_bg = $company_color_code['navbar_bg']; //'#ffffff';
	$nav_txt = $company_color_code['nav_txt']; //'#7b8190';
	$nav_txt_hover = $company_color_code['nav_txt_hover']; //'#5b73e8';

                if(session()->has('branch_set'))
                {
                    $headercolor = session()->branch_brancheader;
					$navbar_bg = session()->branch_branchnavbar; 
					$nav_txt = session()->branch_branchnavtext;
					$nav_txt_hover = session()->branch_branchnavtext;
                }

 ?>

<style>
	
	<?php 

	if(session()->has('branch_set'))
    { ?>
	.authentication-bg {
     background-color: <?=$headercolor ?>;
    }
<?php }else{ ?>
	.authentication-bg {
     background-color: <?=$login_bg ?>;
    }

<?php } ?>

    body[data-layout=horizontal][data-topbar=colored] #page-topbar{
     background-color: <?=$headercolor ?>;	
     }

     .topnav{
		background: <?=$navbar_bg ?>;
     }

     .topnav .navbar-nav .nav-link {
		color: <?=$nav_txt ?>;
     }
     .topnav .navbar-nav .nav-link:hover {
		color: <?=$nav_txt_hover ?> !important;
     }

    .notification-item .unread  {
	  background-color: #f8f9fa !important;
	}
</style>