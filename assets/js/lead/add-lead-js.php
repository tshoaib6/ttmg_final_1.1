<script>
    $(document).ready(function () {
        console.log("Test Lead JS")

        $('#import-lead').click(function () {
            $('#importLeadsModal').modal('show');
        });
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


        $(".select2").select2();

        flatpickr('#datepicker-datetime', {
            enableTime: true,
            dateFormat: "m-d-Y H:i",
            defaultDate: new Date()
        });

        <?php if (isset($camp_id)) { ?>
            camp_id = <?php echo json_encode($camp_id); ?>;
            camp_name = <?php echo json_encode($camp_name['campaign_name']); ?>;
            lead = <?php echo json_encode($lead); ?>;
            complete_lead = JSON.parse(lead.complete_lead);


            $.ajax({
                url: "<?php echo site_url('get-campaign-col_by_id') ?>",
                method: 'POST',
                data: { camp_id: camp_id },
                success: function (response) {
                    $a = JSON.parse(response);
                    col = JSON.parse($a[0].campaign_columns);
                    formHtml = generateLeadForm(col, "", camp_id);
                    $("#form-container").html(formHtml);
                    for (var key in complete_lead) {
                        $('input[name="' + key + '"]').val(complete_lead[key]);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        <?php } ?>

        $('select[name="categoryname"]').on('change', function () {
            $("#import-lead").show();
            var camp_id = $(this).val();
            $('input[name="camp_id"]').val(camp_id);
            $.ajax({
                url: "<?php echo site_url('get-campaign-col_by_id') ?>",
                method: 'POST',
                data: { camp_id: camp_id },
                success: function (response) {
                    $a = JSON.parse(response);
                    col = JSON.parse($a[0].campaign_columns);
                    formHtml = generateLeadForm(col, "", camp_id);
                    $("#form-container").html(formHtml);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });

    });

</script>