

<script>
    $(document).ready(function() {
        var errorMessage = "<?php echo isset($_SESSION['toast-error']) ? $_SESSION['toast-error'] : ''; ?>";
        var successMessage = "<?php echo isset($_SESSION['toast-success']) ? $_SESSION['toast-success'] : ''; ?>";

        if (errorMessage) {
            toastr.error(errorMessage);
        }

        if (successMessage) {
            toastr.success(successMessage);
        }
        <?php $this->model->removeSession('toast-error'); ?>
        <?php $this->model->removeSession('toast-success'); ?>
    });
</script>