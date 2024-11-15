<div class="action-page">
    <form method="post" action="" id="UserDeleteForm">
        <div class="modal">
            <h6><?= $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="warning-title">
                    <div style="color: red;" class="subheading lg">Lưu ý: Một khi xóa sẽ không thể khôi phục, hãy cân
                        nhắc
                        trước khi xóa!</div>
                </div>
                <div class="form-group">
                    <div class="">
                        <label for="text" class="input-group">
                            <input id="text" class="p-md" placeholder="" name="text"
                                value="<?= $data['feature']['text']; ?>" autocomplete="off" disabled>
                            <label for="text" class="sm input-required">
                                Text
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-normal btn-primary">
                    <div class="label md">Xóa</div>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var message = "<?php echo isset($_SESSION['toast-error']) ? $_SESSION['toast-error'] : ''; ?>";
        if (message) {
            toastr.error(message);
        }
        <?php $this->model->removeSession('toast-error'); ?>
    });
</script>