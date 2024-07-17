<?= $this->include('partials/main') ?>

<head>

    <?php echo $title_meta ?>


    </style>

    <?= $this->include('partials/head-css') ?>


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

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <h6>Campaign Name </h6>
                                    <p>
                                        <?php echo $campaign['campaign_name'] ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <h5> Orders </h5>
                            <?= $this->include('orders_management/order-table') ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasImportLead" aria-labelledby="offcanvasImportLeadLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasImportLeadLabel">Import Lead</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body " id="import-lead">
                <form action="<?php echo base_url('upload-lead') ?>" enctype="multipart/form-data" method="POST">
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

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeadForm" aria-labelledby="offcanvasLeadFormLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasLeadFormLabel">Lead Form</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body " id="lead-form">

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
<script src="<?php echo base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/jszip/jszip.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/pdfmake.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/pdfmake/build/vfs_fonts.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.print.min.js')?>"></script>
<script src="<?php echo base_url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.6/xlsx.full.min.js"></script>


<script type="text/javascript">
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
                ajax:  {
                    url: "<?php echo site_url('orders-datatable') ?>/" + <?php echo $campaign['id'] ?>,
                    data: function(d) {
                        order_status=4;
                    d.order_status = order_status;
                    d.filter_campaign ="";
                    d.filter_vendor = "";
                },
                    
    },
                "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                console.log(aData[0]);
            },
               
        });

        
    function importLeads(orderId) {
        var formHTML = `<button onclick="downloadSample(${orderId});" class="btn btn-primary">Download Sample</button>`;

        $("#download-button").html(formHTML);
        $("#order_id_field").val(orderId);
        var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasImportLead);
        bsOffcanvas2.show();

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
    function deleteOrder(orderId) {
        console.log("SSS",orderId)
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
</script>

<!-- App js -->
<script src="<?php echo base_url('assets/js/app.js')?>"></script>

</body>

</html>