<script src="<?= $base_url ?>assets/js/bootstrap.bundle.min.js"></script>

<!-- jQuery CDN -->
<script src="<?= $base_url ?>assets/js/jquery-3.6.0.min.js"></script>

<script>
    function like(event, element) {
        event.preventDefault(); // Prevent the default link behavior
        target  = $(element).data('target');
        id_foto = $(element).data('id_foto');
        $.ajax({
            url: `<?= $base_url ?>foto/like.php`, // Your server-side script URL
            type: 'POST', // Use 'POST' to submit data
            data: { id_foto: id_foto }, // Send as regular form data
            dataType: 'json',
            success: function(data) {
                // Handle the success response
                if (data.is_like) {
                    $(`#like-icon-${id_foto}`).addClass('text-danger');
                } else {
                    $(`#like-icon-${id_foto}`).removeClass('text-danger');
                }
                $(target).html(data.jml_like); // Update the UI
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error:', error);
                alert(error);
            }
        });
    }
</script>