<script>
    function delete_this(url,table) {
        Swal.fire({
            title: "Are you sure?",
            text: "Please ensure and then confirm!",
            confirmButtonText: "Yes, delete the "+table,
            type: "warning",
            showCancelButton: !0,
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function(e) {

            if (e.value === true) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(data) {
                        if (data.msg == "relation_error") {
                            toastr.error('Failed', table+"should be empty to delete");
                        } else {
                            table.row(this).remove().draw(false);
                            toastr.error('Deleted', table+'deleted successfully');
                        };
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });

            } else {
                e.dismiss;
            }

        }, function(dismiss) {
            return false;
        })
    }
</script>