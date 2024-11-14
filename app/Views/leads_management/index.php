<?= $this->include('partials/main') ?>

<head>
    <?php echo $title_meta ?>
    <!-- datepicker css -->
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

        .offcanvas-body {
            max-height: calc(100vh - 150px);
            /* Adjust based on your header height */
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

<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <?php echo $page_title ?>
                <div class="row">
                    <?= $this->include('partials/add-alert') ?>

                    <div class="col-md-12">
                    <?php if (is_admin()) { ?>

                        <div class="card">

                                <div class="card-body">
                                    <div class="row d-flex">
                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label" for="formrow-campaign-input">Client<span class="required"> </span></label>
                                            <select class="form-control select2" name="fkclientid" id="filter_client" style="width: 100%;">
                                                <option value="0">Choose Client...</option>

                                                <?php foreach ($client as $c) { ?>
                                                    <option value="<?php echo $c['id'] ?>">
                                                        <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <div class="col-sm-3 mb-3">
                                            <label class="form-label" for="formrow-campaign-input">Vendors<span class="required"> </span></label>
                                            <select class="form-control select2" name="fkclientid" id="filter_vendor" style="width: 100%;">
                                                <option value="0">Choose Vendor...</option>

                                                <?php foreach ($vendor as $c) { ?>

                                                    <option value="<?php echo $c['id'] ?>">
                                                        <?php echo $c['firstname'] . " " . $c['lastname'] ?>
                                                    </option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-sm-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light filter-clear" style="display:none; margin-right:2px;">Clear Filter</button>

                                    </div>

                                <div class="d-flex flex-row align-item-center">

                                    <div class="d-flex flex-row justify-content-between">
                                        <button class="btn btn-sm btn-primary" onclick="showAddFilter(); return 0;" style="margin-right:10px;" data-toggle="modal" data-target=".filtermodal"><span class="icon"><i class="mdi mdi-filter"></i></span></button>
                                        <button class="btn btn-sm btn-danger" onclick="resetFilter(); return 0;" data-toggle="modal" data-target=".filtermodal"><span class="icon"><i class="mdi mdi-filter-off"></i></span></button>
                                    </div>

                                    <div class="ml-2" style="margin-left:20px;">
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="mm-dd-yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control date_filter" name="start_date" id="start_date" placeholder="Start Date" />
                                            <input type="text" class="form-control date_filter" name="end_date" placeholder="End Date" id="end_date" />
                                        </div>
                                    </div>
                                </div>


                                </div>
                        </div>

                        <?php } ?>


                    </div>

                    <?= $this->include('leads_management/leads-table') ?>
                </div>
            </div>
        </div>

        <?= $this->include('leads_management/reject_lead_modal') ?>
        <?= $this->include('leads_management/lead_detail_canva') ?>
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

                            <div id="dynamic-fields-container" class="d-flex">
                                <div class="col-md-3">
                                    <select class="form-control" name="column[]" id="column" onchange="searchKeyChange(this)">
                                        <option value="0">Choose Option...</option>


                                        <option value="vendor_id">Vendor</option>
                                        <option value="client_id">Client </option>
                                        <option value="phone_number">Phone Number</option>
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



</script>
<script type="text/javascript">
    function filterSubmit() {
        $(".filtermodal").modal('toggle');

        $('input[name="filterActive"]').val("1");
        console.log($('input[name="filterActive"]').val());
        $('#table').DataTable().ajax.reload();
    }


    function searchKeyChange(e, num = "") {

        value = $(e).val();
        console.log("Value is", value);
        searchSelector = $(e).parent().parent().children('.value-div').children();


        if (value == "vendor_id") {
            searchSelector.select2({
                placeholder: {
                    id: '-1',
                    text: 'Type to search'
                }
            })

            $.ajax({
                url: '<?= base_url() ?>get-vendors/',
                dataType: 'json',
                success: function(data) {
                    console.log("Data is here", data);
                    searchSelector.empty();
                    $.each(data, function(i, item) {
                        searchSelector.append($('<option>', {
                            value: item.id,
                            text: item.firstname + " " + item.lastname
                        }));
                    });
                    searchSelector.trigger('change');
                }
            });
        } else if (value == "client_id") {
            searchSelector.select2({
                placeholder: {
                    id: '-1',
                    text: 'Type to search'
                }
            })

            $.ajax({
                url: '<?= base_url() ?>get-clients/',
                dataType: 'json',
                success: function(data) {
                    console.log("Data is here", data);
                    searchSelector.empty();
                    $.each(data, function(i, item) {
                        searchSelector.append($('<option>', {
                            value: item.id,
                            text: item.firstname + " " + item.lastname
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






    function showAddFilter() {
        $('.filtermodal').modal('show');
    }

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

    function resetFilter() {
        $('input[name="filterActive"]').val("0");
        $('#table').DataTable().ajax.reload();
    }

    $(document).ready(function() {
        var radioValue = "";
        var checkedIds = [];

        $('.date_filter').on('change', function(event) {
            console.log("Date Changed");
            table.ajax.reload();
        });


        $('#filter_vendor').on('change', function(event) {
            $('.filter-clear').show();
            console.log("Val", $('#filter_vendor').val());
            table.ajax.reload();
        });

        $('#filter_client').on('change', function(event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });

        $('.filter-clear').on('click', function(event) {
            $('.filter-clear').hide();

            $('#filter_vendor').val(0).trigger('change');
            $('#filter_client').val(0).trigger('change');

        });




        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [{
                    target: 0,
                    visible: false,
                    searchable: false
                },

            ],

            order: [],
            ajax: {
                url: "<?php echo site_url('leads-datatable') ?>/" + 0,
                data: function(d) {

                    var column = [];
                    var operator = [];
                    var value = [];
                    var condition = [];
                    var category = $('select[name="catid"]').val();
                    var filterActive = $('input[name="filterActive"]').val();

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


                    d.column = column;
                    d.operator = operator;
                    d.value = value;
                    d.condition = condition;
                    d.filterActive = filterActive;
                    d.category = category;
                    d.start_date = $("#start_date").val();
                    d.end_date = $("#end_date").val();


                    d.lead_status = radioValue;
                    d.state = $("#state").val();
                    d.filter_vendor = $("#filter_vendor").val() ? $("#filter_vendor").val() : "";
                    d.filter_client = $("#filter_client").val() ? $("#filter_client").val() : "";


                }
            },
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            },

        });
    });
</script>

<script src="assets/js/app.js"></script>
<?php require('assets/js/lead/lead-table-js.php'); ?>



</body>

</html>