<?= $this->include('partials/main') ?>

<head>
    <?php $title_meta ?>


    </style>

    <?= $this->include('partials/head-css') ?>

    <style>
        .offcanvas.offcanvas-end {
            width: 600px;
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

                    <div class="col-lg-8 offset-4">
                        <div class="card">
                            <div class="card-body">
                                <form id="mapping_form" action="<?php echo base_url('import-leads'); ?>"
                                    method="post">

                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Fields</th>
                                                <th>Mapping Fields</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $c1 = 0;
                                            $c2 = 0;
                                            foreach ($header_fields as $value) {
                                                ?>
                                                <tr>
                                                    <th>
                                                        <?php echo $value; ?>
                                                    </th>
                                                    <th>
                                                        <select name="map_head[]" class="form-control">
                                                            <option value="-">Blank</option>
                                                            <?php   //$heads = $this->session->flashdata('header');
                                                                foreach ($header as $col) { ?>
                                                                <option value="<?php echo $col; ?>" <?php //if($c1 == $c2){ echo "selected='selected'"; } ?>>
                                                                    <?php echo $col; ?>
                                                                </option>
                                                                <?php $c2++;
                                                                }
                                                                $c2 = 0; ?>
                                                        </select>
                                                    </th>
                                                </tr>
                                                <?php $c1++;
                                            } ?>

                                        </tbody>
                                    </table>
                                    <input type="hidden" name="cid" value="<?php echo $order_id; ?>">
                                    <input type="hidden" name="camp_id" value="<?php echo $camp_id; ?>">

                                    <input type="submit" class="btn btn-danger btn-block" value="IMPORT">
                                </form>
                            </div>
                        </div>
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

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script type="text/javascript">
    document.getElementById('mapping_form').addEventListener('submit', function(event) {
        let phoneNumberField = document.querySelector('select[name="map_head[]"]').value;
        if (phoneNumberField === "-" || !phoneNumberField.includes("phone_number")) {
            toastr.warning("Phone Number","Phone Number is Required")
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>
