<?= $this->include('./partials/main') ?>

<head>

    <?= $title_meta ?>

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <?= $this->include('partials/datatable-css') ?>
    <?= $this->include('./partials/head-css') ?>

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

                <?= $page_title ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label class="form-label" for="formclientinput">Select Client</label>
                                        <select class="select2 form-select" id="filter_client">
                                            <option value="0">Choose Client...</option>
                                            <?php foreach ($clients as $row) { ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['firstname'] . ' ' . $row['lastname'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label" for="formvendorinput">Select Vendor</label>
                                        <select class="select3 form-select" id="filter_vendor">
                                            <option value="0">Choose Vendor...</option>
                                            <?php foreach ($vendors as $row) { ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['firstname'] . ' ' . $row['lastname'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="form-label">Select Date Range</label>
                                        <div class="input-daterange input-group" id="datepicker6"
                                            data-date-format="mm-dd-yyyy" data-date-autoclose="true"
                                            data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control date_filter" name="start_date"
                                                id="start_date" placeholder="Start Date" />
                                            <input type="text" class="form-control date_filter" name="end_date"
                                                placeholder="End Date" id="end_date" />
                                        </div>
                                    </div>

                                    <div class="col-sm-2 d-flex align-items-end">
                                        <button type="button"
                                            class="btn btn-primary btn-rounded waves-effect waves-light filter-clear"
                                            style="display:none;">Clear Filter</button>
                                    </div>

                                </div>

                                <br>

                                <table id="table" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Activity Log</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- card -->


                </div>
            </div>

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
<?= $this->include('partials/datatable-scripts') ?>


<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="assets/libs/select2/js/select2.min.js"></script>


<script type="text/javascript">

    $(document).ready(function () {
        $(".select2").select2();
        $(".select3").select2();
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

            order: [[0, 'desc']], //init datatable not ordering
            ajax: {
                url: "<?php echo site_url('ajax-activities-datatable') ?>",
                data: function (d) {
                    d.filter_client = $("#filter_client").val();
                    d.filter_vendor = $("#filter_vendor").val();
                    d.start_date = $("#start_date").val();
                    d.end_date = $("#end_date").val();
                }
            },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            }


        });

        $('#filter_client').on('change', function (event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });
        $('#filter_vendor').on('change', function (event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });
        $('.date_filter').on('change', function (event) {
            $('.filter-clear').show();
            //alert('start: '+$("#start_date").val()+" end: "+$("#end_date").val());
            table.ajax.reload();
        });
        $('.filter-clear').on('click', function (event) {
            $('.filter-clear').hide();

            $('#filter_client').val(0).trigger('change');
            $('#filter_vendor').val(0).trigger('change');
            $('#start_date').val('');
            $('#end_date').val('');
            $('#start_date').change();
            $('#end_date').change();
        });

    });
</script>

<!-- App js -->
<?= $this->include('partials/top-alerts') ?>
<script src="assets/js/app.js"></script>




</body>

</html>