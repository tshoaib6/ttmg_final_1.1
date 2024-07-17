<?= $this->include('partials/main') ?>

<head>

    <?php $title_meta ?>
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    </style>

    <?= $this->include('partials/head-css') ?>

    <style>
        .offcanvas.offcanvas-end {
            width: 600px;
        }

        .active-btn {
            background-color: #495cba;
            border: 1px solid #4456ae;
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        }

        #order-report {
            padding: 20px;
            display: none;
        }

        .order-report-card {
            padding: 10px;
            border-right: 1px solid #4456ae;
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
                <button id="all-orders" class="btn btn-primary mb-3 active-btn">All Orders</button>
                <button id="open-orders" class="btn btn-primary mb-3">Open Orders</button>
                <button id="complete-orders" class="btn btn-primary mb-3">Complete Orders</button>
                <button id="blocked-orders" class="btn btn-primary mb-3">Blocked Orders</button>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="form-label" for="formclientinput">Select Category</label>
                                        <select class="select2 form-select" id="filter_campaign">
                                            <option value="0">Choose Category...</option>
                                            <?php foreach ($campaigns as $row) { ?>
                                                <option value="<?= $row['id'] ?>">
                                                    <?= $row['campaign_name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
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

                                    <div class="col-sm-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light filter-clear" style="display:none;">Clear Filter</button>
                                    </div>

                                </div>
                                <br>
                                <div class="lead-summary">
                                    <button class="btn btn-default btn-with-tooltip" id="slideDown">
                                        <i class="fa fa-align-left"></i>
                                    </button>

                                    <div class="lead-content" id="order-report">
                                        <div class="row ">
                                            <div class="col-md-3 order-report-card"><b> Total Orders : </b></div>
                                            <div class="col-md-3 order-report-card"><b> Active Orders : </b></div>
                                            <div class="col-md-3 order-report-card"><b> Complete Orders : </b></div>
                                            <div class="col-md-3 order-report-card"><b> Blocked Orders : </b></div>

                                        </div>
                                    </div>
                                </div>

                                <br>
                                <?= $this->include('orders_management/order-table') ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>

        <!-- End Page-content -->
        <!-- right offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">User Detail</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" id="userDetails">

            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeadForm" aria-labelledby="offcanvasLeadFormLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasLeadFormLabel">Lead Form</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body " id="lead-form">

            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasImportLead" aria-labelledby="offcanvasImportLeadLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasImportLeadLabel">Import Lead</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body " id="import-lead">
                <form action="upload-lead" enctype="multipart/form-data" method="POST">
                    <label for="formFileLg" class="form-label">Upload File</label>
                    <input class="form-control form-control-lg mb-3" id="formFileLg" type="file" name="csvfile" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                    <input type="hidden" id="order_id_field" name="order_id">
                    <div class="row d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary"> Upload </button>
                    </div>
                </form>
                <hr>
                <div id="download-button" class="row d-flex justify-content-center">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

</script>
<script type="text/javascript">
    function blockOrder(id = "") {
        if (confirm("Do you want to block the Order ?") == true) {
            $.ajax({
                url: '<?php echo site_url('block-order') ?>',
                type: 'POST',
                data: {
                    orderId: id
                },
                success: function(response) {
                    console.log(response);
                    $('#table').DataTable().ajax.reload();

                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        } else {

        }
    }

    function deleteOrder(orderId) {
    if (confirm('Are you sure you want to delete this order?')) {
        $.ajax({
            url: '<?php echo site_url('delete-order')?>',
            type: 'GET',
            data:{orderId:orderId},
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#table').DataTable().ajax.reload()
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error : ' + error);
            }
        });
    }
}


    function unblockOrder(id = "") {
        if (confirm("Do you want to Unblock the Order ?") == true) {
            $.ajax({
                url: '<?php echo site_url('unblock-order') ?>',
                type: 'POST',
                data: {
                    orderId: id
                },
                success: function(response) {
                    console.log(response);
                    $('#table').DataTable().ajax.reload();

                },
                error: function(error) {
                    console.error('AJAX request failed:', error);
                }
            });
        } else {

        }
    }

    function addLeadToOrder(orderId) {
        $.ajax({
            url: '<?php echo site_url('lead-form-ajax') ?>',
            type: 'GET',
            data: {
                orderId: orderId
            },
            success: function(response) {
                $a = JSON.parse(response);
                col = JSON.parse($a.campaign_columns);

                formHTML = generateLeadForm(col, orderId);
                $("#lead-form").html(formHTML);
            },
            error: function(error) {
                console.error('AJAX request failed:', error);
            }
        });
        var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasLeadForm);
        bsOffcanvas2.show();
    }

    function downloadSample(orderId) {
        $.ajax({
            url: 'get-campaign-col',
            method: 'POST',
            data: {
                orderId: orderId
            },
            success: function(response) {
                console.log(response);
                var headers = JSON.parse(response);
                headers = headers.map(item => item.col_slug);
                const ws = XLSX.utils.aoa_to_sheet([headers]);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');
                XLSX.writeFile(wb, 'output.xlsx');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    }

    function importLeads(orderId) {
        var formHTML = `<button onclick="downloadSample(${orderId});" class="btn btn-primary">Download Sample</button>`;

        $("#download-button").html(formHTML);
        $("#order_id_field").val(orderId);
        var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasImportLead);
        bsOffcanvas2.show();

    }

    $(document).ready(function() {


        $("#slideDown").click(function() {
            $("#order-report").slideToggle("slow");
        });


        order_status = 4;
        $('#all-orders').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            order_status = 4;
            table.ajax.reload();

        });

        $('#open-orders').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            order_status = 1;
            table.ajax.reload();

        });

        $('#complete-orders').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            order_status = 3;
            table.ajax.reload();

        });

        $('#blocked-orders').click(function() {
            $(this).addClass('active-btn');
            $('button').not(this).removeClass('active-btn');
            order_status = 0;
            table.ajax.reload();

        });

        $('#filter_campaign').on('change', function(event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });
        $('#filter_vendor').on('change', function(event) {
            $('.filter-clear').show();
            table.ajax.reload();
        });

        $('.filter-clear').on('click', function(event) {
            $('.filter-clear').hide();

            $('#filter_campaign').val(0).trigger('change');
            $('#filter_vendor').val(0).trigger('change');
        });

        <?php if (session()->getFlashdata('error')) : ?>
            toastr.error('Error!', '<?= session()->getFlashdata('error') ?>')
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            toastr.success('Success!', '<?= session()->getFlashdata('success') ?>')
        <?php endif; ?>


        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [],
            order: [],
            ajax: {
                url: "<?php echo site_url('orders-datatable') ?>/" + <?php echo "0" ?>,
                data: function(d) {
                    d.order_status = order_status;
                    d.filter_campaign = $("#filter_campaign").val();
                    d.filter_vendor = $("#filter_vendor").val();
                },
            },

            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            }
        });


    });
</script>

<!-- App js -->
<script src="assets/js/app.js"></script>




</body>

</html>