<?= $this->include('partials/main') ?>

<head>

    <?php $title_meta ?>
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

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
                    <?= $this->include('orders_management/order-table') ?>


                </div>

            </div> <!-- container-fluid -->
        </div>

        <!-- End Page-content -->
        <!-- right offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">User Detail</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" id="userDetails">

            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeadForm"
            aria-labelledby="offcanvasLeadFormLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasLeadFormLabel">Lead Form</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body " id="lead-form">

            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasImportLead"
            aria-labelledby="offcanvasImportLeadLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasImportLeadLabel">Import Lead</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body " id="import-lead">
                <form action="upload-lead" enctype="multipart/form-data" method="POST">
                    <label for="formFileLg" class="form-label">Upload File</label>
                    <input class="form-control form-control-lg mb-3" id="formFileLg" type="file" name="csvfile" required
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
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

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

</script>
<script type="text/javascript">


    function blockOrder(id = "") {
        if (confirm("Do you want to block the Order ?") == true) {
            $.ajax({
                url: '<?php echo site_url('block-order') ?>',
                type: 'POST',
                data: { orderId:  id},
                success: function (response) {
                console.log(response);
                $('#table').DataTable().ajax.reload();

                },
                error: function (error) {
                    console.error('AJAX request failed:', error);
                }
            });
        } else {

        }
    }

    function unblockOrder(id="") {
        if (confirm("Do you want to Unblock the Order ?") == true) {
            $.ajax({
                url: '<?php echo site_url('unblock-order') ?>',
                type: 'POST',
                data: { orderId:  id},
                success: function (response) {
                console.log(response);
                $('#table').DataTable().ajax.reload();

                },
                error: function (error) {
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
            data: { orderId: orderId },
            success: function (response) {
                $a = JSON.parse(response);
                col = JSON.parse($a.campaign_columns);

                formHTML = generateLeadForm(col, orderId);
                $("#lead-form").html(formHTML);
            },
            error: function (error) {
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
            data: { orderId: orderId },
            success: function (response) {
                console.log(response);
                var headers = JSON.parse(response);
                headers = headers.map(item => item.col_slug);
                const ws = XLSX.utils.aoa_to_sheet([headers]);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');
                XLSX.writeFile(wb, 'output.xlsx');
            },
            error: function (xhr, status, error) {
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

    $(document).ready(function () {

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [
            ],
            order: [],
            ajax: {
                url: "<?php echo site_url('orders-datatable') ?>/" + <?php echo "0" ?>,

            },
            "fnCreatedRow": function (nRow, aData, iDataIndex) {
                $(nRow).attr('id', aData[0]);
            }


        });


        var offcanvasright = document.getElementById('offcanvasRight')
        table.on('click', 'tr:not(:first)', function (e) {
            if ($(e.target).is($(this).find('td:last')) || $(e.target).is($(this).find('i')) || $(e.target).is($(this).find('button'))) {
                return;
            }
            var uid = $(this).attr('id');
            $.ajax({
                url: '<?= base_url() ?>/getuserid/' + uid,
                type: 'get',
                success: function (data) {
                    $("#userDetails").html(data);
                }
            });
            var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasright);
            bsOffcanvas2.show();
        });

    });
</script>

<!-- App js -->
<script src="assets/js/app.js"></script>




</body>

</html>