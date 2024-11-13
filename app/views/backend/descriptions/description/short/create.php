<div class="action-page">
    <form method="post" action="" id="ShortDescCreateForm">
        <div class="modal short-desc">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
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

            <div class="create-desc">
                <button type="button" class="btn btn-normal btn-iconOnly btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                    </svg>
                </button>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-normal btn-primary submitForm">
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