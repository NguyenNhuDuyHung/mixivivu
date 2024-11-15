abc


<script>
    $(document).ready(function () {
        var message = "<?php echo isset($data['login-success']) ? $data['login-success'] : ''; ?>";

        if (message) {
            toastr.success(message);
        }
    });

</script>