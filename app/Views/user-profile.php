<?= $this->include('partials/main') ?>

    <head>
        
        <?= $title_meta ?>

        <?= $this->include('partials/head-css') ?>

    </head>

    <?= $this->include('partials/body') ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?= $this->include('partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?= $page_title ?>
                      
                        <?php //var_dump($session->login_useruimage) ?>
                        <div class="row mb-4">
                            <div class="col-xl-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <!-- <div class="dropdown float-end">
                                                <a class="text-body dropdown-toggle font-size-18" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                  <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                              
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Remove</a>
                                                </div>
                                            </div> -->
                                            <div class="clearfix"></div>
                                            <div>
                                                <img src="<?php echo base_url('uploads/users/').$session->login_useruimage; ?>" alt="" class="avatar-lg rounded-circle img-thumbnail">
                                            </div>
                                            <h5 class="mt-3 mb-1"><?php echo $session->login_firstname.' '.$session->login_lastname; ?></h5>

                                            <!-- <div class="mt-4">
                                                <button type="button" class="btn btn-light btn-sm"><i class="uil uil-envelope-alt me-2"></i> Message</button>
                                            </div> -->
                                        </div>

                                        <hr class="my-4">

                                        <div class="text-muted">
                                            <!-- <h5 class="font-size-16">About</h5>
                                            <p>Hi I'm Marcus,has been the industry's standard dummy text To an English person, it will seem like simplified English, as a skeptical Cambridge.</p> -->
                                            <div class="table-responsive mt-4">
                                                <div>
                                                    <p class="mb-1">Email :</p>
                                                    <h5 class="font-size-16"><?= $session->login_email ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Phone :</p>
                                                    <h5 class="font-size-16"><?= $session->login_phone ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Address :</p>
                                                    <h5 class="font-size-16"><?= $session->login_address ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Website :</p>
                                                    <h5 class="font-size-16"><?= $session->login_website ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Coverage Area :</p>
                                                    <h5 class="font-size-16"><?= $session->login_coverage ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Linkedin :</p>
                                                    <h5 class="font-size-16"><?= $session->login_linkedin ?></h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="card mb-0">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                                                <i class="uil uil-user-circle font-size-20"></i>
                                                <span class="d-none d-sm-block">Orders</span> 
                                            </a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab">
                                                <i class="uil uil-clipboard-notes font-size-20"></i>
                                                <span class="d-none d-sm-block">Clients</span> 
                                            </a>
                                        </li>
                                       <!-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                                <i class="uil uil-envelope-alt font-size-20"></i>
                                                <span class="d-none d-sm-block">Messages</span>   
                                            </a>
                                        </li> -->
                                    </ul>
                                    <!-- Tab content -->
                                <div class="tab-content p-4">
                                    <div class="tab-pane active" id="about" role="tabpanel">
                                            <div>
                                                <div>
                                                    <h5 class="font-size-16 mb-4">Orders</h5>

                                                    <div class="table-responsive">
                                                     S   <table class="table table-nowrap table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Projects</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Status</th>
                                                                    <th scope="col" style="width: 120px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">01</th>
                                                                    <td><a href="#" class="text-reset ">Brand Logo Design</a></td>
                                                                    <td>
                                                                        18 Jun, 2020
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-primary-subtle text-primary font-size-12">Open</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="uil uil-ellipsis-v"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">02</th>
                                                                    <td><a href="#" class="text-reset ">Minible Admin</a></td>
                                                                    <td>
                                                                        06 Jun, 2020
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-primary-subtle text-primary font-size-12">Open</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="uil uil-ellipsis-v"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">03</th>
                                                                    <td><a href="#" class="text-reset ">Chat app Design</a></td>
                                                                    <td>
                                                                        28 May, 2020
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="uil uil-ellipsis-v"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">04</th>
                                                                    <td><a href="#" class="text-reset ">Minible Landing</a></td>
                                                                    <td>
                                                                        13 May, 2020
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="uil uil-ellipsis-v"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">05</th>
                                                                    <td><a href="#" class="text-reset ">Authentication Pages</a></td>
                                                                    <td>
                                                                        06 May, 2020
                                                                    </td>
                                                                    <td>
                                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                                <i class="uil uil-ellipsis-v"></i>
                                                                            </a>
                                                                        
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tasks" role="tabpanel">
                                            <div>
                                                <h5 class="font-size-16 mb-3">Active</h5>

                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 60px;">
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-activeCheck2">
                                                                        <label class="form-check-label" for="tasks-activeCheck2"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Ecommerce Product Detail</a>
                                                                </td>
                                                                
                                                                <td>27 May, 2020</td>
                                                                <td style="width: 160px;"><span class="badge bg-primary-subtle text-primary font-size-12">Active</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-activeCheck1">
                                                                        <label class="form-check-label" for="tasks-activeCheck1"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Ecommerce Product</a>
                                                                </td>
                                                                
                                                                <td>26 May, 2020</td>
                                                                <td><span class="badge bg-primary-subtle text-primary font-size-12">Active</span></td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="font-size-16 my-3">Upcoming</h5>

                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 60px;">
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck3">
                                                                        <label class="form-check-label" for="tasks-upcomingCheck3"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Chat app Page</a>
                                                                </td>
                                                                
                                                                <td>-</td>
                                                                <td style="width: 160px;"><span class="badge bg-secondary-subtle text-secondary font-size-12">Waiting</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck2">
                                                                        <label class="form-check-label" for="tasks-upcomingCheck2"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Email Pages</a>
                                                                </td>
                                                                
                                                                <td>04 June, 2020</td>
                                                                <td><span class="badge bg-primary-subtle text-primary font-size-12">Approved</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck1">
                                                                        <label class="form-check-label" for="tasks-upcomingCheck1"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Contacts Profile Page</a>
                                                                </td>
                                                                
                                                                <td>-</td>
                                                                <td><span class="badge bg-secondary-subtle text-secondary font-size-12">Waiting</span></td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="font-size-16 my-3">Complete</h5>

                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 60px;">
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck3">
                                                                        <label class="form-check-label" for="tasks-completeCheck3"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">UI Elements</a>
                                                                </td>
                                                                
                                                                <td>27 May, 2020</td>
                                                                <td style="width: 160px;"><span class="badge bg-success-subtle text-success font-size-12">Complete</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck2">
                                                                        <label class="form-check-label" for="tasks-completeCheck2"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Authentication Pages</a>
                                                                </td>
                                                                
                                                                <td>27 May, 2020</td>
                                                                <td><span class="badge bg-success-subtle text-success font-size-12">Complete</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck1">
                                                                        <label class="form-check-label" for="tasks-completeCheck1"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-reset ">Admin Layout</a>
                                                                </td>
                                                                
                                                                <td>26 May, 2020</td>
                                                                <td><span class="badge bg-success-subtle text-success font-size-12">Complete</span></td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="messages" role="tabpanel">
                                            <div>
                                                <div data-simplebar style="max-height: 430px;">
                                                    <div class="d-flex align-items-start border-bottom py-4">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img class="rounded-circle avatar-xs" src="assets/images/users/avatar-3.jpg" alt="avatar-3 images">
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-15 mb-1">Marion Walker <small class="text-muted float-end">1 hr ago</small></h5>
                                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting .</p>
            
                                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                                class="mdi mdi-reply"></i> Reply</a>
            
                                                            <div class="d-flex align-items-start mt-4">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img class="rounded-circle avatar-xs" src="assets/images/users/avatar-4.jpg" alt="avatar-4 images">
                                                                </div>
                                                                
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-15 mb-1">Shanon Marvin <small class="text-muted float-end">1 hr ago</small></h5>
                                                                    <p class="text-muted">It will be as simple as in fact, it will be Occidental. To it will seem like simplified .</p>
            
                                                                    
                                                                    <a href="javascript: void(0);" class="text-muted font-13 d-inline-block">
                                                                        <i class="mdi mdi-reply"></i> Reply
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-start border-bottom py-4">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img class="rounded-circle avatar-xs" src="assets/images/users/avatar-5.jpg" alt="avatar-5 images">
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-15 mb-1">Janice Morgan <small class="text-muted float-end">2 hrs ago</small></h5>
                                                            <p class="text-muted">To achieve this, it would be necessary to have uniform pronunciation.</p>
            
                                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                                class="mdi mdi-reply"></i> Reply</a>
            
                                                        </div>
                                                    </div>
    
                                                    <div class="d-flex align-items-start border-bottom py-4">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img class="rounded-circle avatar-xs" src="assets/images/users/avatar-7.jpg" alt="avatar-7 images">
                                                        </div>
                                                        
                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-15 mb-1">Patrick Petty <small class="text-muted float-end">3 hrs ago</small></h5>
                                                            <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error sit </p>
            
                                                            <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i
                                                                class="mdi mdi-reply"></i> Reply</a>
            
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="border rounded mt-4">
                                                    <form action="#">
                                                        <div class="px-2 py-1 bg-light">
                                                            
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-sm btn-link text-reset  text-decoration-none"><i class="uil uil-link"></i></button>
                                                                <button type="button" class="btn btn-sm btn-link text-reset  text-decoration-none"><i class="uil uil-smile"></i></button>
                                                                <button type="button" class="btn btn-sm btn-link text-reset  text-decoration-none"><i class="uil uil-at"></i></button>
                                                              </div>
                                                            
                                                        </div>
                                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>
                                                        
                                                    </form>
                                                </div> <!-- end .border-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?= $this->include('partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('partials/right-sidebar') ?>

        <?= $this->include('partials/vendor-scripts') ?>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>
