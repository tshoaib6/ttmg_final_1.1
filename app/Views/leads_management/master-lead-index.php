<?= $this->include('partials/main') ?>

<head>

    <?php $title_meta ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.css') ?>">
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />

    <?= $this->include('partials/datatable-css') ?>
    <?= $this->include('partials/head-css') ?>

    <style>
        .select2-container {
            z-index: 100000;
        }

        .offcanvas.offcanvas-end {
            width: 600px;
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

        .active-btn {
            background-color: #495cba;
            border: 1px solid #4456ae;
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
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
                <button id="all-leads" class="btn btn-primary mb-3 active-btn">All Leads</button>
                <button id="unassigned-leads" class="btn btn-primary mb-3">Unassigned</button>
                <button id="assigned-leads" class="btn btn-primary mb-3">Assigned</button>
                <div class="row">
                    <?= $this->include('leads_management/master-leads-table') ?>
                </div>
            </div>
        </div>
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
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
                                <textarea class="form-control status-box" rows="3" placeholder="Enter your notes here..."></textarea>
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
                                <input type="text" name="remainder_title" class="form-control rform" required id="remainder" value="<?php echo set_value('remainder'); ?>">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control discription-box" rows="3" placeholder="Description..."></textarea>
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
</div>


<!-- Filter Modal -->
<div class="modal fade bs-example-modal-center filtermodal modal-lg" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Lead Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div id="query-container">

                    <div class="query-row row">

                        <select hidden="" name="condition[]">
                            <option value="AND">and</option>
                        </select>

                        <input type="hidden" name="filterActive" value="0">

                        <div class="row">
                            <div class="col-md-2 d-flex jusitify-content-end">
                                <label>WHERE </label>
                            </div>


                            <div class="col-md-3">
                                <select class="form-control" name="column[]" id="column" onchange="searchKeyChange(this)">
                                    <option value="agent_name">Agent</option>
                                    <option value="name">Name </option>
                                    <option value="phone_number">Phone Number</option>
                                    <option value="address">Address</option>
                                    <option value="state">State</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="operator[]" style="width: 170px;font-size: 14px;display: inline;" id="operator">
                                    <option value="is">is</option>
                                    <option value="is not">is not</option>
                                    <option value="contains">contains</option>
                                    <option value="does not contain">does not contain</option>
                                    <option value="is blank">is blank</option>
                                    <option value="is not blank">is not blank</option>

                                </select>
                            </div>
                            <div class="col-md-3 value-div">
                                <select class="form-control search" name="value[]" style="width: 170px;font-size: 14px;display: inline-block;">
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-primary ml-5 mt-4" onclick="addRow()"><i class="fa fa-plus-circle"></i> Add filter</button>
                <div class="form-group">
                    <span class="col-sm-1">
                        <label class="" style="font-weight: 480;font-size: 14px;margin-top: 10px;">AND
                            Category
                        </label>
                    </span>
                    <select class="form-control" name="catid" id="catid">
                        <option value="0">Select Category</option>
                        <?php foreach ($camp_name as $cn) { ?>
                            <option value="<?php echo $cn['id'] ?>"><?php echo $cn['campaign_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="filterSubmit()" data-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>






<?= $this->include('partials/right-sidebar') ?>
<?= $this->include('partials/vendor-scripts') ?>
<?= $this->include('partials/datatable-scripts') ?>


<script src="assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>



<script type="text/javascript">
    function createListItem(currentDateTime, post) {
        var listItem = $('<li>');
        var dateTimeSpan = $('<span>').text(currentDateTime).addClass('datetime');
        var postSpan = $('<span>').text(post).css('color', 'black').addClass('post');
        listItem.append(dateTimeSpan).append(' - ').append(postSpan);
        return listItem;
    }



    function showAddFilter() {
        $('.filtermodal').modal('show');
    }

    function resetFilter() {
        $('input[name="filterActive"]').val("0");
        $('#table').DataTable().ajax.reload();
    }

    function getAgent() {
        $('select[name="value[]"]').select2({
            placeholder: {
                id: '-1',
                text: 'Type to search'
            }
        });

        $.ajax({
            url: '<?= base_url() ?>get-agents/',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, item) {
                    $('select[name="value[]"]').append($('<option>', {
                        value: item.agent_name,
                        text: item.agent_name
                    }));
                });
            }
        });
    }
    var num = 0;

    function addRow() {
        var orignalRow = $('.query-row').first();
        orignalRow.find(".search").each(function(index) {
            $(this).select2('destroy');
        });
        var newRow = orignalRow.clone();
        newRow.find('select[name="condition[]"]').addClass('form-control col-md-12 mt-2 mb-2').css("width", "100px");
        newRow.find('select[name="condition[]"]').removeAttr('hidden').html('');
        newRow.find('select[name="condition[]"]').append(
            '<option value="AND"> AND </option> <option value="OR" >OR </option>')

        var removeLink = $(
            '<div class="col-sm-1 mt-3" style="padding-left:unset;"><a href="javascript:;" class="text-center" onclick="removeRow(this)" style="vertical-align:sub;color: #00396D;"><i class="fa fa-minus-circle"></i></a></div>'
        );
        newRow.find('.row').append(removeLink);

        newRow.appendTo('#query-container');
        $("select.search").select2();
    }

    function removeRow(e) {
        $(e).closest('.query-row').remove();
    }

    function searchKeyChange(e, num = "") {
        value = $(e).val();
        console.log("Value is", value);
        searchSelector = $(e).parent().parent().children('.value-div').children();

        if (value == "agent_name") {
            searchSelector.select2({
                placeholder: {
                    id: '-1',
                    text: 'Type to search'
                }
            })

            $.ajax({
                url: '<?= base_url() ?>get-agents/',
                dataType: 'json',
                success: function(data) {
                    searchSelector.empty();
                    $.each(data, function(i, item) {
                        searchSelector.append($('<option>', {
                            value: item.agent_name,
                            text: item.agent_name
                        }));
                    });
                    searchSelector.trigger('change');
                }
            });
        } else if (value == "state") {
            searchSelector.empty();

            searchSelector.select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Type to search'
                }
            })
            const usStates = [
                "Alabama",
                "Alaska",
                "Arizona",
                "Arkansas",
                "California",
                "Colorado",
                "Connecticut",
                "Delaware",
                "Florida",
                "Georgia",
                "Hawaii",
                "Idaho",
                "Illinois",
                "Indiana",
                "Iowa",
                "Kansas",
                "Kentucky",
                "Louisiana",
                "Maine",
                "Maryland",
                "Massachusetts",
                "Michigan",
                "Minnesota",
                "Mississippi",
                "Missouri",
                "Montana",
                "Nebraska",
                "Nevada",
                "New Hampshire",
                "New Jersey",
                "New Mexico",
                "New York",
                "North Carolina",
                "North Dakota",
                "Ohio",
                "Oklahoma",
                "Oregon",
                "Pennsylvania",
                "Rhode Island",
                "South Carolina",
                "South Dakota",
                "Tennessee",
                "Texas",
                "Utah",
                "Vermont",
                "Virginia",
                "Washington",
                "West Virginia",
                "Wisconsin",
                "Wyoming"
            ];
            usStates.forEach(state => {
                searchSelector.append($('<option>', {
                    value: state,
                    text: state
                }));
                searchSelector.trigger('change');

                console.log(searchSelector.val());

            });
        } else {
            searchSelector.parent().html('<input class="form-control" name="value[]" >')
        }

    }

    function filterSubmit() {
        $(".filtermodal").modal('toggle');

        $('input[name="filterActive"]').val("1");
        console.log($('input[name="filterActive"]').val());
        $('#table').DataTable().ajax.reload();
    }


    $(document).ready(function() {

        getAgent();
        var lead_status = 0;
        var checkedIds = [];
        $('.date_filter').on('change', function(event) {
            console.log("Date Changed");
            table.ajax.reload();
        });

        <?php if (session()->getFlashdata('error')) : ?>
            toastr.error('Error!', '<?= session()->getFlashdata('error') ?>')
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            toastr.success('Success!', '<?= session()->getFlashdata('success') ?>')
        <?php endif; ?>

        $('#all-leads').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            lead_status = 0;
            console.log("Lead Status", lead_status)
            $("#table").DataTable().ajax.reload();

        });

        $('#unassigned-leads').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            lead_status = 2;
            console.log("Lead Status", lead_status)
            $("#table").DataTable().ajax.reload();

        });

        $('#assigned-leads').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            lead_status = 1;
            console.log("Lead Status", lead_status)
            $("#table").DataTable().ajax.reload();
        });
        // 
        // Note & Remainders 
        $('#post-btn').click(function() {
            var post = $('.status-box').val();
            var id = $('input[name="l_id"]').val();
            var currentDateTime = new Date().toLocaleString();
            listItem = createListItem(currentDateTime, post);
            if (post.trim() !== '') {
                $.ajax({
                    url: '<?= base_url() ?>save-notes/',
                    type: 'POST',
                    data: {
                        post: post,
                        id: id
                    },
                    success: function(response) {
                        toastr.success('Note Added', 'Note Added Successfully')
                    },
                    error: function(error) {
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
        $('#remainder-btn').click(function() {
            var post = $('.discription-box').val();
            var id = $('input[name="l_id"]').val();
            var title = $('input[name="remainder_title"]').val();
            var datetime = $('input[name="orderdate"]').val();

            var currentDateTime = new Date().toLocaleString();
            listItem = createListItem(currentDateTime, post);

            if (post.trim() !== '') {
                $.ajax({
                    url: '<?= base_url() ?>save-remainder/',
                    type: 'POST',
                    data: {
                        title: title,
                        post: post,
                        id: id,
                        datetime: datetime
                    },
                    success: function(response) {
                        toastr.success('Remainder Added', 'Remainder Added Successfully')
                    },
                    error: function(error) {
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
        // 

        // DataTable   
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [{
                target: 0,
                visible: false,
                searchable: false
            }, ],
            order: [],
            ajax: {
                url: "<?php echo site_url('master-leads-datatable') ?>/" + 0,
                data: function(d) {
                    var column = [];
                    var operator = [];
                    var value = [];
                    var condition = [];
                    var category = $('select[name="catid"]').val();
                    var filterActive = $('input[name="filterActive"]').val();
                    // var filterActive = 0;

                    $('select[name="column[]"]').each(function() {
                        column.push($(this).val());
                    });
                    $('select[name="operator[]"]').each(function() {
                        operator.push($(this).val());
                    });
                    if ($('select[name="value[]"]').length > 0) {
                        $('select[name="value[]"]').each(function() {
                            value.push($(this).val());
                        });
                    } else {
                        $('input[name="value[]"]').each(function() {
                            value.push($(this).val());
                        });
                    }

                    $('select[name="condition[]"]').each(function() {
                        condition.push($(this).val());
                    });

                    console.log("Column", column);
                    console.log("Operator", operator);
                    console.log("Value", value);
                    console.log("Condition", condition);
                    console.log("Filter Active", category);
                    
                    console.log("Date Start",$("#start_date").val())
                    console.log("Date Start",$("#end_date").val())




                    d.column = column;
                    d.operator = operator;
                    d.value = value;
                    d.condition = condition;
                    d.filterActive = filterActive;
                    d.lead_status = lead_status;
                    d.category = category;
                    d.start_date = $("#start_date").val();
                    d.end_date = $("#end_date").val();
                }
            },
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },

        });
        // 

        // Canvas Right 
        var offcanvasright = document.getElementById('offcanvasRight')
        table.on('click', 'tr:not(:first)', function(e) {
            if ($(e.target).is($(this).find('td:last')) || $(e.target).is($(this).find('i')) || $(e.target)
                .is($(this).find('button')) || $(e.target).is($(this).find('input'))) {
                return;
            }
            var uid = $(this).attr('id');
            $('.posts').html("");
            $('.remainder').html("");

            $('input[name="l_id"]').val(uid);

            $.ajax({
                url: '<?= base_url() ?>/getnotes/' + uid,
                type: 'get',
                success: function(data) {
                    notes = JSON.parse(data);
                    notes.forEach(element => {
                        listItem = createListItem(element.created_at, element
                            .note_text);
                        listItem.prependTo('.posts');
                    });


                }
            });

            $.ajax({
                url: '<?= base_url() ?>/getremainder/' + uid,
                type: 'get',
                success: function(data) {
                    notes = JSON.parse(data);
                    console.log("noe", notes);
                    notes.forEach(element => {
                        listItem = createListItem(element.remainder_time_date, element
                            .remainder_text);
                        listItem.prependTo('.remainder');
                    });
                }
            });

            $.ajax({
                url: '<?= base_url() ?>/getleaddetail/' + uid,
                type: 'get',
                success: function(data) {
                    console.log(data);
                    $("#lead-detail").html(data);
                }
            });
            var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasright);
            bsOffcanvas2.show();
        });

        // 


        $('#table tbody').on('change', 'input[type="checkbox"]', function() {
            console.log("Clicked")
            $('#table tbody input[type="checkbox"]').each(function() {
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

            if (checkedIds.length > 0) {
                $("#assign-container").show();
            } else {
                $("#assign-container").hide();
            }

        });



        $("#assign-btn").click(function() {
            $("#lead_id").val(checkedIds.toString())
            $("#lead_assign_form").submit();
        });
    });
</script>

<!-- App js -->
<script src="assets/js/app.js"></script>
</body>

</html>