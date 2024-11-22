<div class="main">
    <?php require_once __DIR__ . '/components/BreadCrumbs.php'; ?>
    <?php require_once __DIR__ . '/components/Navigation.php'; ?>
    <?php require_once __DIR__ . '/components/Carousel.php'; ?>
    <?php require_once __DIR__ . '/components/SideBarMb.php'; ?>
    <?php require_once __DIR__ . '/components/Detail.php'; ?>
    <?php require_once __DIR__ . '/components/Popup.php'; ?>
</div>

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