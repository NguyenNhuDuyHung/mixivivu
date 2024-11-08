<div class="action-page">
    <form method="post" action="" id="ShortDescDeleteForm">
        <div class="modal">
            <h6><?= $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input-3">
                <div class="warning-title">
                    <div style="color: red;" class="subheading lg">Lưu ý: Một khi xóa sẽ không thể khôi phục, hãy cân
                        nhắc
                        trước khi xóa!</div>
                </div>
                <div class="form-group">
                    <div class="">
                        <label for="description" class="input-group">
                            <input id="description" class="p-md" name="description"
                                value="<?= $data['short_desc']['description']; ?>" autocomplete="off" disabled>
                            <label for="description" class="sm input-required">
                                Description
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="product" class="input-group">
                            <input id="product" class="p-md" name="product"
                                value="<?= $data['product']['title']; ?>" autocomplete="off" disabled>
                            <label for="product" class="sm input-required">
                                Product
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