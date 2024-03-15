<?= $this->include('partials/main') ?>

<head>

    <?php $title_meta ?>
    <!-- datepicker css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.css') ?>">
    <link href="<?php echo base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />

    </style>
    <?= $this->include('partials/datatable-css') ?>
    <?= $this->include('partials/head-css') ?>
    <style>

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

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>

                                            <th>Agent Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>State</th>
                                            <th>Phone Number</th>
                                            <th>Status </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($leads as $lead) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $lead['agent_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $lead['firstname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $lead['lastname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $lead['state'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $lead['phone_number'] ?>
                                                </td>
                                                <td>
                                                    <?php if ($lead['duplicate'] == 1) {
                                                        echo '<span class="badge bg-danger"> Duplicate </span> ';
                                                    } else if ($lead['duplicate'] == 3) {
                                                        echo '<span class="badge bg-danger"> Exceded </span> ';
                                                    } else { {
                                                            echo '<span class="badge bg-success"> Assigned </span> ';
                                                        }
                                                    } ?>
                                                </td>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>


        <!-- right offcanvas -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>
<?= $this->include('partials/datatable-scripts') ?>


<script src="<?php echo base_url('assets/libs/flatpickr/flatpickr.min.js') ?>"></script>
<script src="<?php echo base_url('assets/libs/select2/js/select2.min.js') ?>"></script>




<script type="text/javascript">

    $(document).ready(function () {

    });

</script>

<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js') ?>"></script>




</body>

</html>