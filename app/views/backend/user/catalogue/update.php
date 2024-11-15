<div class="action-page">
    <form method="post" action="" id="UserCatalogueUpdateForm">
        <div class="modal">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="name" class="input-group">
                            <input id="name" class="p-md" placeholder="Nhập tên nhóm người dùng" name="name"
                                value="<?php echo $this->oldInfo('name', $data) ?? $data['user_catalogue']['name']; ?>"
                                autocomplete="off">
                            <label for="name" class="sm input-required">
                                Tên nhóm người dùng
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="description" class="input-group">
                            <input id="description" class="p-md" placeholder="Nhập mô tả" name="description"
                                value="<?php echo $this->oldInfo('description', $data) ?? $data['user_catalogue']['description']; ?>"
                                autocomplete="off">
                            <label for="description" class="sm input-required">
                                Mô tả
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>


            <div class="actions">
                <button type="submit" class="btn btn-normal btn-primary">
                    <div class="label md">Cập nhật</div>
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