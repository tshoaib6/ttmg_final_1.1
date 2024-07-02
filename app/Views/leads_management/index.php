<?= $this->include('partials/main') ?>

<head>

    <?php $title_meta ?>
    <!-- datepicker css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.css') ?>">
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />   

    <?= $this->include('partials/datatable-css') ?>
    <?= $this->include('partials/head-css') ?>


    <style>
        .offcanvas.offcanvas-end {
            width: 600px;
        }

        .offcanvas-body {
            max-height: calc(100vh - 150px); /* Adjust based on your header height */
            overflow-y: auto;
        }

        .counter {
            display: inline;
            margin-top: 0;
            margin-bottom: 0;
            margin-right: 10px;
        }

        .posts {
            clear: both;
            list-style: none;
            padding-left: 0;
            width: 100%;
            text-align: left;
        }

        .posts li {
            background-color: #fff;
            border: 1.5px solid #d8d8d8;
            border-radius: 10px;
            padding-top: 10px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 10px;
            margin-bottom: 10px;
            word-wrap: break-word;
            min-height: 42px;
        }
    </style>

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

                <?php echo $page_title ?>

                <div class="row">
                    <?= $this->include('partials/add-alert') ?>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex">
                                <?php if( is_admin()){ ?>
                                    <div class="col-sm-3 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Client<span
                                                class="required"> </span></label>
                                        <select class="form-control select2" name="fkclientid" style="width: 100%;">
                                            <?php foreach ($client as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>">
                                                    <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                </option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="col-sm-3 mb-3">
                                        <label class="form-label" for="formrow-campaign-input">Vendors<span
                                                class="required"> </span></label>
                                        <select class="form-control select2" name="fkclientid" style="width: 100%;">
                                            <?php foreach ($client as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>">
                                                    <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                </option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                </div>
                                <button id="filter-btn" class="btn btn-primary mb-3">Filter</button>
                                <?php } ?>

                                <div class="row  " id="assign-container" style="display:none !important;">
                                    <form id="lead_assign_form" action="<?= base_url() ?>assign-leads/" method="POST">
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label" for="formrow-campaign-input">Order<span
                                                    class="required"> * </span></label>
                                            <select class="form-control select2" name="order_id" required
                                                style="width: 100%;">
                                                <?php foreach ($order as $o) { ?>
                                                    <option value="<?php echo $o['pkorderid'] ?>">
                                                        <?php echo $o['agent'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <input id="lead_id" type="hidden" value="" name="leadId">
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <button id="assign-btn" type="button" class="btn btn-primary mb-3">Assign
                                            </button>
                                        </div>
                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>

                    <?= $this->include('leads_management/leads-table') ?>
                </div>

            </div> <!-- container-fluid -->
        </div>

        <!-- Modal -->
        <div class="modal fade bs-example-modal-center" id="rejectLeadModal" tabindex="-1" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Lead</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="reject_lead_form">
                            <div class="col-sm-12 mb-3">
                                <label class="form-label" for="formrow-reason-input">Reason <span class="required"> *
                                    </span></label>
                                <textarea name="reason" class="form-control rform" required id="reason">
                            </textarea>
                            </div>
                            <input type="hidden" name="l_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="rejectLeadSubmit()" class="btn btn-primary">Save </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--                         -->

        <!-- End Page-content -->
        <!-- right offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Lead Detail</h5>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#lead_detail" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Lead Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#notes" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Notes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#remainder" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Remainder</span>
                        </a>
                    </li>

                </ul>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="lead_detail" role="tabpanel">
                    <div class="offcanvas-body" id="lead-detail">

                    </div>
                </div>
                <div class="tab-pane" id="notes" role="tabpanel">
                    <div class="container">
                        <form id="notes-form">
                            <div class="form-group">
                                <textarea class="form-control status-box" rows="3"
                                    placeholder="Enter your notes here..."></textarea>
                            </div>

                            <input type="hidden" value name="l_id">
                        </form>
                        <div class="button-group pull-right">
                            <p class="counter">250</p>
                            <a href="#" id="post-btn" class="btn btn-primary mt-3">Post</a>
                        </div>
                        <ul class="posts  mt-3">
                        </ul>
                    </div>
                </div>
                <div class="tab-pane" id="remainder" role="tabpanel">

                    <div class="container">
                        <form id="remainder-form">
                            <div class="col-sm-12 mb-3">
                                <label class="form-label" for="formrow-remainder-input">Title<span class="required"> *
                                    </span></label>
                                <input type="text" name="remainder_title" class="form-control rform" required
                                    id="remainder" value="<?php echo set_value('remainder'); ?>">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control discription-box" rows="3"
                                    placeholder="Description..."></textarea>
                            </div>

                            <input type="hidden" value name="l_id">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="formrow-orderdate-input">Date / Time</label>
                                <input type="text" class="form-control" name="orderdate" id="datepicker-datetime">
                            </div>
                        </form>
                        <div class="button-group pull-right">
                            <a href="#" id="remainder-btn" class="btn btn-primary mt-3">Post</a>
                        </div>
                        <ul class="remainder  mt-3">
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>
<?= $this->include('partials/vendor-scripts') ?>
<?= $this->include('partials/datatable-scripts') ?>


<script src="assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>



</script>
<script type="text/javascript">

    function acceptLead(leadID) {
        console.log("lead", leadID);
    var isConfirmed = confirm("Are you sure you want to accept this lead?");
    if (isConfirmed) {
        $.ajax({
            url: '<?= base_url() ?>accept-lead/',
            type: 'post',
            data: { id: leadID },
            success: function (data) {
                console.log("Shoaib", data);
                toastr.success('Lead Accepted', 'Lead Accepted Successfully')
                // $('#rejectLeadModal').modal('hide');
                $('#table').DataTable().ajax.reload(); // Reload DataTable
            }
        });
    } else {

        console.log("Lead acceptance canceled");
    }
}

    function rejectLead(leadID) {

        $('#rejectLeadModal').modal('show');
    $('input[name="l_id"]').val(leadID);


    console.log("Lead Rejecterd");
    }

    function rejectLeadSubmit() {
        $formData = $("#reject_lead_form").serialize();
    $.ajax({
        url: '<?= base_url() ?>reject-lead/',
    type: 'post',
    data: $formData,
    success: function (data) {
        toastr.error('Lead Rejected', 'Lead Rejected Successfully')
                $('#rejectLeadModal').modal('hide');
    $('#table').DataTable().ajax.reload(); // Reload DataTable
            }
        });
    return 0;
    }

    function createListItem(currentDateTime, post) {
    var listItem = $('<li>');
        var dateTimeSpan = $('<span>').text(currentDateTime).addClass('datetime');
            var postSpan = $('<span>').text(post).css('color', 'black').addClass('post');
                listItem.append(dateTimeSpan).append(' - ').append(postSpan);
                return listItem;           
}



                $(document).ready(function () {
                    var radioValue="";
                var checkedIds = [];

//                 function assign_form_submit() {

                    //                     console.log("PRESEDEd ")
                    // $("#lead_id").val(checkedIds.toString())
                    //                 $("#lead_assign_form").submit();
                    // }

                    $(".select2").select2();

                flatpickr('#datepicker-datetime', {
                    enableTime: true,
                dateFormat: "m-d-Y H:i",
                defaultDate: new Date()
                    });

                $('#post-btn').click(function () {
                        var post = $('.status-box').val();
                var id = $('input[name="l_id"]').val();

                var currentDateTime = new Date().toLocaleString();
                listItem = createListItem(currentDateTime, post);

                if (post.trim() !== '') {
                    $.ajax({
                        url: '<?= base_url() ?>save-notes/',
                        type: 'POST',
                        data: { post: post, id: id },
                        success: function (response) {
                            toastr.success('Note Added', 'Note Added Successfully')
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                        }

                listItem.prependTo('.posts');
                $('.status-box').val('');
                $('.counter').text('250');
                $('#post-btn').addClass('disabled');
                    });


                $('.status-box').keyup(function() {
    var postLength = $(this).val().length;
                var charactersLeft = 250 - postLength;
                $('.counter').text(charactersLeft);
                if (charactersLeft < 0) {
                    $('#post-btn').addClass('disabled');
    } else if (charactersLeft === 250) {
                    $('#post-btn').addClass('disabled');
    } else {
                    $('#post-btn').removeClass('disabled');
    }
  });
                $('#post-btn').addClass('disabled');


                //

                $('#remainder-btn').click(function () {
                var post = $('.discription-box').val();
                var id = $('input[name="l_id"]').val();
                var title = $('input[name="remainder_title"]').val();
                var datetime=$('input[name="orderdate"]').val();

                var currentDateTime = new Date().toLocaleString();
                listItem = createListItem(currentDateTime, post);

                if (post.trim() !== '') {
                    $.ajax({
                        url: '<?= base_url() ?>save-remainder/',
                        type: 'POST',
                        data: { title: title, post: post, id: id, datetime: datetime },
                        success: function (response) {
                            toastr.success('Remainder Added', 'Remainder Added Successfully')
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                        }

                listItem.prependTo('.reaminders');
                $('.discription-box').val('');
                $('.counter').text('250');
                $('#remainder-btn').addClass('disabled');
                    });


                $('.discription-box').keyup(function() {
    var postLength = $(this).val().length;
                var charactersLeft = 250 - postLength;
                $('.counter').text(charactersLeft);
                if (charactersLeft < 0) {
                    $('#remainder-btn').addClass('disabled');
    } else if (charactersLeft === 250) {
                    $('#remainder-btn').addClass('disabled');
    } else {
                    $('#remainder-btn').removeClass('disabled');
    }
  });
                $('#remainder-btn').addClass('disabled');


                var table = $('#table').DataTable({
                    processing: true,
                serverSide: true,
                columnDefs: [
                {
                    target: 0,
                visible: false,
                searchable: false
                },

                ],

                order: [],
                ajax: {
                    url: "<?php echo site_url('leads-datatable') ?>/" + 0,
                data:function(d){
                    d.lead_status = radioValue;
                d.state=$("#state").val();
                d.client=$('select[name="fkclientid"]').val();
                
                    }
    },
                "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
            },
               
        });
                var offcanvasright = document.getElementById('offcanvasRight')
                table.on('click', 'tr:not(:first)', function (e) {
    if ($(e.target).is($(this).find('td:last')) || $(e.target).is($(this).find('i')) || $(e.target).is($(this).find('button'))|| $(e.target).is($(this).find('input'))) {
        return;
    }
                var uid = $(this).attr('id');
                $('.posts').html("");
                $('.remainder').html("");

                $('input[name="l_id"]').val(uid);

                $.ajax({
                    url: '<?= base_url() ?>/getnotes/' + uid,
                type: 'get',
                success: function (data) {
                    notes = JSON.parse(data);
                    notes.forEach(element => {
                    listItem = createListItem(element.created_at, element.note_text);
                listItem.prependTo('.posts');
                    });
            
                    
        }
    });

                $.ajax({
                    url: '<?= base_url() ?>/getremainder/' + uid,
                type: 'get',
                success: function (data) {
                    notes = JSON.parse(data);
                console.log("noe",notes);
                    notes.forEach(element => {
                    listItem = createListItem(element.remainder_time_date, element.remainder_text);
                listItem.prependTo('.remainder');
                    });
            
                    
        }
    });



                $.ajax({
                    url: '<?= base_url() ?>/getleaddetail/' + uid,
                type: 'get',
                success: function (data) {
                    console.log("SSS");
                    console.log(data);
                $("#lead-detail").html(data);
        }
    });
                var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasright);
                bsOffcanvas2.show();
});
                $('#table tbody').on('change', 'input[type="checkbox"]', function(){

                    $('#table tbody input[type="checkbox"]').each(function () {
                        var trId = $(this).closest('tr').attr('id');
                        var isChecked = $(this).is(':checked');

                        if (isChecked && checkedIds.indexOf(trId) === -1) {
                            checkedIds.push(trId);
                        } else if (!isChecked) {
                            var index = checkedIds.indexOf(trId);
                            if (index !== -1) {
                                checkedIds.splice(index, 1);
                            }
                        }
                    });
                  
                  if(checkedIds.length>0){
                    $("#assign-container").show();
                  }
                else{
                    $("#assign-container").hide();
                  }
            
                });

                $('#filter-btn').click(function () {
                    radioValue = $('input[name=formRadios]:checked').val();
                console.log("sd", radioValue);
                $('#table').DataTable().ajax.reload();

                        });


                $('select[name=fkclientid]').change(function(){

                });



                $("#assign-btn").click(function(){
                    console.log("PRESEDEd ")
$("#lead_id").val(checkedIds.toString())
                $("#lead_assign_form").submit();
                });

   

    });
</script>

<!-- App js -->
<script src="assets/js/app.js"></script>




</body>

</html>