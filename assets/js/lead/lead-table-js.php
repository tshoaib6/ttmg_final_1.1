<script>
    function deleteLead(id) {
        if (confirm('Are you sure you want to delete this lead?')) {
            $.ajax({
                url: '<?= site_url('delete-lead/') ?>' + id,
                type: 'GET',
                success: function(response) {
                    if (JSON.parse(response).success) {
                        toastr.success('Lead Delete', 'Lead Deleted Successfully')
                        console.log(response);
                        // Reload the datatable
                        $('#table').DataTable().ajax.reload();
                    } else {
                        console.log(JSON.parse(response).success);
                        // toastr.error('Lead Delete', 'Error')
                    }
                },
                error: function() {
                    alert('Error deleting lead');
                }
            });
        }
    }

    function acceptLead(leadID) {
        console.log("lead", leadID);
        var isConfirmed = confirm("Are you sure you want to accept this lead?");
        if (isConfirmed) {
            $.ajax({
                url: '<?= base_url() ?>accept-lead/',
                type: 'post',
                data: {
                    id: leadID
                },
                success: function(data) {
                    console.log("Shoaib", data);
                    toastr.success('Lead Accepted', 'Lead Accepted Successfully')
                    // $('#rejectLeadModal').modal('hide');
                    $('#table').DataTable().ajax.reload(); // Reload DataTable
                }
            });
        } else {

            console.log("Lead acceptance canceled");
        }
    }

    function rejectLead(leadID) {

        $('#rejectLeadModal').modal('show');
        $('input[name="l_id"]').val(leadID);


        console.log("Lead Rejecterd");
    }

    function rejectLeadSubmit() {
        $formData = $("#reject_lead_form").serialize();
        $.ajax({
            url: '<?= base_url() ?>reject-lead/',
            type: 'post',
            data: $formData,
            success: function(data) {
                toastr.error('Lead Rejected', 'Lead Rejected Successfully')
                $('#rejectLeadModal').modal('hide');
                $('#table').DataTable().ajax.reload(); // Reload DataTable
            }
        });
        return 0;
    }

    function createListItem(currentDateTime, post) {
        var listItem = $('<li>');
        var dateTimeSpan = $('<span>').text(currentDateTime).addClass('datetime');
        var postSpan = $('<span>').text(post).css('color', 'black').addClass('post');
        listItem.append(dateTimeSpan).append(' - ').append(postSpan);
        return listItem;
    }
    $(document).ready(function() {
        var table = $('#table');




       

        $("#download-csv").click(function() {
            console.log("Shoaib")
        });

        



        $('#post-btn').click(function() {
            var post = $('.status-box').val();
            var id = $('input[name="l_id"]').val();

            var currentDateTime = new Date().toLocaleString();
            listItem = createListItem(currentDateTime, post);

            if (post.trim() !== '') {
                $.ajax({
                    url: '<?= base_url() ?>save-notes/',
                    type: 'POST',
                    data: {
                        post: post,
                        id: id
                    },
                    success: function(response) {
                        toastr.success('Note Added', 'Note Added Successfully')
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            listItem.prependTo('.posts');
            $('.status-box').val('');
            $('.counter').text('250');
            $('#post-btn').addClass('disabled');
        });
        $('.status-box').keyup(function() {
            var postLength = $(this).val().length;
            var charactersLeft = 250 - postLength;
            $('.counter').text(charactersLeft);
            if (charactersLeft < 0) {
                $('#post-btn').addClass('disabled');
            } else if (charactersLeft === 250) {
                $('#post-btn').addClass('disabled');
            } else {
                $('#post-btn').removeClass('disabled');
            }
        });
        $('#post-btn').addClass('disabled');
        $('#remainder-btn').click(function() {
            var post = $('.discription-box').val();
            var id = $('input[name="l_id"]').val();
            var title = $('input[name="remainder_title"]').val();
            var datetime = $('input[name="orderdate"]').val();

            var currentDateTime = new Date().toLocaleString();
            listItem = createListItem(currentDateTime, post);

            if (post.trim() !== '') {
                $.ajax({
                    url: '<?= base_url() ?>save-remainder/',
                    type: 'POST',
                    data: {
                        title: title,
                        post: post,
                        id: id,
                        datetime: datetime
                    },
                    success: function(response) {
                        toastr.success('Remainder Added', 'Remainder Added Successfully')
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            listItem.prependTo('.reaminders');
            $('.discription-box').val('');
            $('.counter').text('250');
            $('#remainder-btn').addClass('disabled');
        });
        $('.discription-box').keyup(function() {
            var postLength = $(this).val().length;
            var charactersLeft = 250 - postLength;
            $('.counter').text(charactersLeft);
            if (charactersLeft < 0) {
                $('#remainder-btn').addClass('disabled');
            } else if (charactersLeft === 250) {
                $('#remainder-btn').addClass('disabled');
            } else {
                $('#remainder-btn').removeClass('disabled');
            }
        });
        $('#remainder-btn').addClass('disabled');


        var offcanvasright = document.getElementById('offcanvasRight')
        table.on('click', 'tr:not(:first)', function(e) {
            console.log
            if ($(e.target).is($(this).find('td:last')) || $(e.target).is($(this).find('i')) || $(e.target).is($(this).find('button')) || $(e.target).is($(this).find('input'))) {
                return;
            }
            var uid = $(this).attr('id');
            $('.posts').html("");
            $('.remainder').html("");

            $('input[name="l_id"]').val(uid);

            $.ajax({
                url: '<?= base_url() ?>/getnotes/' + uid,
                type: 'get',
                success: function(data) {
                    notes = JSON.parse(data);
                    notes.forEach(element => {
                        listItem = createListItem(element.created_at, element.note_text);
                        listItem.prependTo('.posts');
                    });


                }
            });

            $.ajax({
                url: '<?= base_url() ?>/getremainder/' + uid,
                type: 'get',
                success: function(data) {
                    notes = JSON.parse(data);
                    console.log("noe", notes);
                    notes.forEach(element => {
                        listItem = createListItem(element.remainder_time_date, element.remainder_text);
                        listItem.prependTo('.remainder');
                    });


                }
            });



            $.ajax({
                url: '<?= base_url() ?>/getleaddetail/' + uid,
                type: 'get',
                success: function(data) {
                    console.log("SSS");
                    console.log(data);
                    $("#lead-detail").html(data);
                }
            });
            var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasright);
            bsOffcanvas2.show();
        });


    });
</script>