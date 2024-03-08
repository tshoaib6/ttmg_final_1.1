

<?= $this->include('./partials/main') ?>

<head>

    <?= $title_meta ?>

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'); ?>"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>"
        rel="stylesheet" type="text/css" />
    <?= $this->include('./partials/head-css') ?>

    <style>

.table-striped-duplicate>tbody>tr:nth-child(odd)>td,
.table-striped-duplicate>tbody>tr:nth-child(odd)>th {
  background-color: #FF4747;
  color: white;
}
.table-striped-duplicate>tbody>tr:nth-child(even)>td,
.table-striped-duplicate>tbody>tr:nth-child(even)>th {
  background-color: #ff3333b8;
  color: white;
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

                <?= $page_title ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4> Uploaded Leads </h4>
                                <table id="table" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Agent Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>State</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php foreach($post_data as $leads){ ?> 
                                <tr> 
                                    <td> <?php echo $leads['agent_name'] ?> </td>
                                    <td> <?php echo $leads['firstname'] ?> </td>
                                    <td> <?php echo $leads['lastname'] ?> </td>
                                    <td> <?php echo $leads['state'] ?> </td>
                                    <td> <?php echo $leads['phone_number'] ?> </td>
                                    <?php } ?> 
                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 


                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4> Duplicate Leads </h4>
                                <table id="table" class="table table-striped-duplicate table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Agent Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>State</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php foreach($duplicate as $leads){ ?> 
                                <tr> 
                                    <td> <?php echo $leads['agent_name'] ?> </td>
                                    <td> <?php echo $leads['firstname'] ?> </td>
                                    <td> <?php echo $leads['lastname'] ?> </td>
                                    <td> <?php echo $leads['state'] ?> </td>
                                    <td> <?php echo $leads['phone_number'] ?> </td>
                                    <?php } ?> 
                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 


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

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="assets/libs/select2/js/select2.min.js"></script>


<script type="text/javascript">

    $(document).ready(function () {
        <?php if(session()->getFlashdata('error')): ?>
            toastr.error('Error!', '<?= session()->getFlashdata('error') ?>')
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            toastr.success('Success!', '<?= session()->getFlashdata('success') ?>')
        <?php endif; ?>

        history.pushState(null, null, window.location.href);
        window.onpopstate = function(event) {
        window.location.href = '/order-index';
};
    });
</script>

<!-- App js -->
<?= $this->include('partials/top-alerts') ?>
<script src="assets/js/app.js"></script>




</body>

</html>