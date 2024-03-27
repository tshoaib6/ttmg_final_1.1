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
                                <div class="row d-flex justify-content-between top-setting">


                                    <div class="col-sm-1">
                                        <button id="add-new" class="btn btn-primary mb-3">Add New </button>
                                    </div>
                                </div>

                                <br>

                                <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>State</th>
                                            <th>Email</th>
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

    <div id="add-clients-modal" class="modal fade bs-bulklead-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Clients</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="upload-client-data" enctype="multipart/form-data" method="POST">
                        <label for="formFileLg" class="form-label">Upload File</label>
                        <input class="form-control form-control-lg mb-3" id="formFileLg" type="file" name="csvfile" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />


                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> Upload </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
    $(document).ready(function() {


        $(".top-setting").prepend(generateStateSelect());
        $('#add-new').click(function() {
            $('#add-clients-modal').modal('show');
        });

        $('select[name="state"]').change(
            function() {
                $("#table").DataTable().ajax.reload();
            }
        )
        $(".select2").select2();
        $(".select3").select2();
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,

            order: [
                [0, 'desc']
            ], //init datatable not ordering
            ajax: {
                url: "<?php echo site_url('ajax-clients-datatable') ?>",
                data: function(d) {
                    d.state = $('select[name="state"]').val();
                }
            },
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            }


        });

        $('#filter_client').on('change', function(event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });
        $('#filter_vendor').on('change', function(event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });
        $('.date_filter').on('change', function(event) {
            $('.filter-clear').show();
            //alert('start: '+$("#start_date").val()+" end: "+$("#end_date").val());
            table.ajax.reload();
        });
        $('.filter-clear').on('click', function(event) {
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