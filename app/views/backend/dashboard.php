abc

<?php
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?>

<script>
    $(document).ready(function () {
        var message = "<?php echo isset($data['login-success']) ? $data['login-success'] : ''; ?>";

        if (message) {
            toastr.success(message);
        }
    });

</script>