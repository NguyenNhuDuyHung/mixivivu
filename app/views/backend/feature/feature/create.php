<div class="action-page">
    <form method="post" action="" id="FeatureCreateForm">
        <div class="modal">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="text" class="input-group">
                            <input id="text" class="p-md" placeholder="Nhập tên đặc trưng" name="text"
                                value="<?php echo $this->oldInfo('text', $data) ?>" autocomplete="off">
                            <label for="text" class="sm input-required">
                                Text
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="select-input">
                        <label for="type" class="input-group">
                            <input id="type" class="p-md" placeholder="Chọn loại đặc trưng" name="type"
                                value="<?php echo $this->oldInfo('type', $data) ?>" autocomplete="off">
                            <label for="type" class="sm input-required">
                                Chọn loại đặc trưng
                            </label>
                        </label>

                        <div class="dropdown">
                            <?php foreach ($data['feature_types'] as $feature_type): ?>
                                <div class="dropdown-item" value="<?= $feature_type['name'] ?>">
                                    <?= $feature_type['name'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>


            </div>

            <div class="group-input-1">
                <div class="form-group">
                    <div class="">
                        <label for="icon" class="input-group">
                            <textarea id="icon" class="p-md" placeholder="Nhập icon.  Lưu ý: Nhập thẻ svg" name="icon" autocomplete="off"><?php echo $this->oldInfo('icon', $data) ?></textarea>
                            <label for="icon" class="sm input-required">
                                Icon
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-normal btn-primary">
                    <div class="label md">Tạo</div>
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