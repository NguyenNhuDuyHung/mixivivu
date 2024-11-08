<div class="action-page">
    <form method="post" action="" id="ShortDescCreateForm">
        <div class="modal">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="description" class="input-group">
                            <input id="description" class="p-md" placeholder="Nhập mô tả ngắn" name="description"
                                value="<?php echo $this->oldInfo('description', $data) ?>" autocomplete="off">
                            <label for="description" class="sm input-required">
                                Description
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="select-input">
                        <label for="product_id" class="input-group">
                            <input id="product_id" class="p-md" placeholder="Chọn sản phẩm" name="product_id"
                                value="<?php echo $this->oldInfo('product_id', $data) ?>" autocomplete="off">
                            <label for="product_id" class="sm input-required">
                                ProductID
                            </label>
                        </label>

                        <div class="dropdown">
                            <?php foreach ($data['products'] as $product) : ?>
                                <div class="dropdown-item" value="<?php echo $product['id']; ?>">
                                    <?php echo $product['title']; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
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