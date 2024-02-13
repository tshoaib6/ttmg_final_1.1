<?= $this->include('./partials/main') ?>

    <head>
        
        <?= $title_meta ?>

        <?= $this->include('./partials/head-css') ?>
        <style>
            .chat-list li a.active{
               background-color:#faebd7;
            }
        </style>
    </head>

    <?= $this->include('./partials/body') ?>

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?= $this->include('./partials/menu') ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <?=  $page_title ?>
                       <div class="d-lg-flex mb-4">
                        <?php if(is_admin()){ ?>
                            <div class="chat-leftsidebar card">
                                <div class="p-3">
                                    <div class="search-box chat-search-box">
                                        <div class="position-relative">
                                            <input type="text" class="form-control bg-light border-light rounded searchuser" placeholder="Search...">
                                            <i class="uil uil-search search-icon"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="pb-3">
                                    <div class="chat-message-list" data-simplebar>
                                        
                                        <div class="p-4">
                                            <div>        
                                                <ul class="list-unstyled chat-list">
                                                   
                                                     
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end chat-leftsidebar -->
                        <?php }else{ ?>
                        <div class="chat-leftsidebar card">
                            <div class="p-3">
                                <label class="form-label" for="formRequestTypeinput">Request Type</label>
                            <select class="form-control form-select" id="request_type" name="RequestType" required="" >
                                    <option value="General">General</option>
                                    <option value="Order">Order</option>
                                    <option value="Lead">Lead</option>
                                    <option value="Other">Other</option>
                            </select>

                            </div>
                            <div class="p-3">
                            <label class="form-label" for="formmessageinput">Message</label>
                            <textarea name="message" id="client_message" class="form-control"></textarea>
                            </div>

                            <div class="p-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light w-md" id="client_msg_send">
                                Send
                            </button>
                            </div>
                        </div>

                        <?php } ?>    

                            <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1">
                                <div class="card">
                                    <div class="p-3 px-lg-4 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 col-6">
                                                <h5 class="font-size-16 mb-1 text-truncate"><a  class="text-reset currentuser"><?=get_user_fullname() ?></a></h5>
                                                
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <ul class="list-inline user-chat-nav text-end mb-0">
                                                    <li class="list-inline-item">
                                                        <div class="dropdown">
                                                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="uil uil-search"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                                                <!-- <form class="p-2">
                                                                    <div>
                                                                        <input type="text" class="form-control rounded" placeholder="Search...">
                                                                    </div>
                                                                </form> -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                  

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="chat-conversation py-3">
                                            <ul class="list-unstyled mb-0 chat-conversation-message px-3" id="chat-conversation-message" data-simplebar>
                      
                                            </ul>
                                        </div>
                                    </div>
                            <?php if(is_admin()){ ?>
                                    <div class="p-3 chat-input-section">
                                        <div class="row">
                                            <div class="col">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control chat-input rounded" id="admin_msg" placeholder="Enter Message...">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-primary chat-send w-md waves-effect waves-light" id="admin_msg_send" disabled><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i></button>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- End d-lg-flex  -->
                            
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <?= $this->include('./partials/footer') ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?= $this->include('./partials/right-sidebar') ?>

        <?= $this->include('./partials/vendor-scripts') ?>

     
    <script type="text/javascript">
 
    $(window).on('load',function() {
        <?php if(!is_admin()){ ?>
            var uid = <?=get_user_id() ?>;
        $.ajax({
                    url:"<?=base_url('ajax-chat-user-msg/') ?>"+uid,
                    method: "GET",
                    dataType: "json",
                    success: function(data)
                    {
                       if(data['html'].length > 0)
                       {
                           $('#chat-conversation-message .simplebar-content').html(data['html']);
                           $(".simplebar-content-wrapper").animate({ scrollTop: $('.simplebar-content-wrapper').height() }, "fast");
                       }else{
                           $('#chat-conversation-message .simplebar-content').html("no user found..."); 
                       }
                        
                    },
                });
    <?php }
        if(is_admin()){
     ?>
        $.ajax({
            url:"<?=base_url('ajax-chat-user-list') ?>",
            method: "GET",
            dataType: "json",
            success: function(data)
            {
                //var u = JSON.parse(data);
                //console.log(data['html']);
               if(data['html'].length > 0)
               {
                   $('.chat-list').html(data['html']); 
               }else{
                   $('.chat-list').html("no user found..."); 
               }
                
            },
        });
        <?php } ?>
    });

        $("#admin_msg").on('keyup',function(){
            if($(this).val().length > 3)
            {
             $('#admin_msg_send').prop("disabled", false);
            }else{
               $('#admin_msg_send').prop("disabled", true); 
            }
        });
        $("#admin_msg_send").on('click',function(){

                var admin_message = $("#admin_msg").val();
                var current_user_name = $(".currentuser").data('name');
                var current_user_id = $(".currentuser").data('id');
                var html = '';
                //alert("Request: "+ client_request_type+" Message: "+client_message);

                html +='<li class="right"><div class="conversation-list"><div class="ctext-wrap"><div class="ctext-wrap-content"><h5 class="font-size-14 conversation-name">';
                html +='<a href="#" class="text-reset ">Support Service</a> <span class="d-inline-block font-size-12 text-muted ms-2">now</span></h5>';
                html +='<p class="mb-0">'+admin_message+'</p></div><div class="dropdown align-self-start"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></a>';
                html +='<div class="dropdown-menu"><a class="dropdown-item" href="#" onClick="delete_msg(this,"1")">Delete</a></div></div></div> </div></li>';

                $('#chat-conversation-message .simplebar-content').append(html);

                $(".simplebar-content-wrapper").animate({ scrollTop: $('.simplebar-content-wrapper').height() }, "fast");
                $.ajax({
                    url:"<?=base_url('ajax-chat-admin-send-msg') ?>",
                    method: "POST",
                    data: {message:admin_message,user_id:current_user_id,user_name:current_user_name },
                    success: function(data)
                    {
                       //alert('added');
                        
                    },
                });

            });


            $("#client_msg_send").on('click',function(){

                var client_request_type = $("#request_type").val();
                var client_message = $("#client_message").val();
                var current_user_name = $(".currentuser").html();
                var current_user_id = <?=get_user_id() ?>;
                var html = '';
                //alert("Request: "+ client_request_type+" Message: "+client_message);

                html +='<li><div class="conversation-list"><div class="ctext-wrap"><div class="ctext-wrap-content"><h5 class="font-size-14 conversation-name">';
                html +='<a href="#" class="text-reset ">'+current_user_name+'</a> <span class="d-inline-block font-size-12 text-muted ms-2">now</span></h5>';
                html +='<h6>['+client_request_type+']</h6>';
                html +='<p class="mb-0">'+client_message+'</p></div><div class="dropdown align-self-start"><a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></a>';
                html +='<div class="dropdown-menu"><a class="dropdown-item" href="#" onClick="delete_msg(this,"1")">Delete</a></div></div></div> </div></li>';

                $('#chat-conversation-message .simplebar-content').append(html);

                $(".simplebar-content-wrapper").animate({ scrollTop: $('.simplebar-content-wrapper').height() }, "fast");
                $.ajax({
                    url:"<?=base_url('ajax-chat-client-send-msg') ?>",
                    method: "POST",
                    data: {request_type:client_request_type,message:client_message,user_id:current_user_id,user_name:current_user_name },
                    success: function(data)
                    {
                       //alert('added');
                        
                    },
                });

            });

            $(".searchuser").on('keyup',function(){
            //console.log('change');
            var s = $(this).val();
            $('.chat-list li').each(function(i, obj) {
                 var query = $(this).data('name').toLowerCase();
                 if(query.indexOf(s) != -1)
                 {
                    $(this).show();
                 }else{
                    $(this).hide();
                 }
                });
            });

            $(document).on('click','.chat-list li a',function(){
                $(this).addClass('active');
                var username = $(this).closest('li').data('name');
                var uid = $(this).closest('li').data('id');
                $('a.currentuser').html(username);
                $('a.currentuser').attr("data-name",username);
                $('a.currentuser').attr("data-id",uid);
                $('.chat-list li a').not(this).each(function(i, obj){
                    $(this).removeClass('active');
                });

                $(this).find('.unread-message').remove();

                $.ajax({
                    url:"<?=base_url('ajax-chat-user-msg/') ?>"+uid,
                    method: "GET",
                    dataType: "json",
                    success: function(data)
                    {
                       if(data['html'].length > 0)
                       {
                           $('#chat-conversation-message .simplebar-content').html(data['html']); 
                           $(".simplebar-content-wrapper").animate({ scrollTop: $('.simplebar-content-wrapper').height() }, "fast");

                       }else{
                           $('#chat-conversation-message .simplebar-content').html("no user found..."); 
                       }
                        
                    },
                });

            });
    </script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>


   

    </body>
</html>
