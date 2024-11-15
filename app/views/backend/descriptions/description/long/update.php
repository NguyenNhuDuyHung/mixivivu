<div class="action-page">
    <form method="post" action="" id="LongDescCreateForm" enctype="multipart/form-data">
        <div class="modal long-desc">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="warning-title">
                <div style="color: red;" class="subheading lg">Lưu ý: Thứ tự tạo mô tả sẽ tương ứng với thứ tự khi render ra chi tiết sản phẩm!</div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="select-input">
                        <label for="product_id" class="input-group">
                            <input id="product_id" class="p-md" placeholder="Chọn sản phẩm" name="product_id"
                                value="<?php echo $this->oldInfo('product_id', $data) ?? $data['id'] ?>" autocomplete="off">
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

            <div class="flex align-center gap-16 create-desc">
                <div class="create-header">
                    <button type="button" class="btn btn-normal btn-outline">
                        <div class="label md">Tạo header</div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg>
                    </button>
                </div>

                <div class="create-paragraph">
                    <button type="button" class="btn btn-normal btn-outline">
                        <div class="label md">Tạo paragraph</div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg>
                    </button>
                </div>

                <div class="create-image">
                    <button type="button" class="btn btn-normal btn-outline">
                        <div class="label md">Tạo image</div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <?php
            foreach ($data['descriptions'] as $key => $description) {
                $uniqueId = bin2hex(random_bytes(4));
                if ($description['type'] == '1') {
                    echo '<div class="flex align-center gap-8">
                                        <div class="form-group" style="flex: 1">
                                <div class="">
                                    <label for="header' . $uniqueId . '" class="input-group">
                                        <textarea id="header' . $uniqueId . '" class="p-md" placeholder="Nhập text" name="text[]" data-type="1"
                                            autocomplete="off">' . $description['text'] . '</textarea>
                                            <input type="hidden" name="type[]" value="1">
                                        <label for="header' . $uniqueId . '" class="sm input-required">
                                            Header
                                        </label>
                                    </label>
                                </div>
                                <div class="error"></div>
                            </div>
                            <button type="button" class="btn btn-normal btn-outline btn-iconOnly delete-desc">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </button>
                        </div>';
                }

                if ($description['type'] == '2') {
                    echo '<div class="flex align-center gap-8">
                            <div class="form-group" style="flex: 1">
                            <div class="">
                                <label for="paragraph' . $uniqueId . '" class="input-group">
                                    <textarea id="paragraph' . $uniqueId . '" class="p-md" placeholder="Nhập text" name="text[]" data-type="2"
                                        autocomplete="off"> ' . $description['text'] . '</textarea>
                                        <input type="hidden" name="type[]" value="2">
                                    <label for="paragraph' . $uniqueId . '" class="sm input-required">
                                        Paragraph
                                    </label>
                                </label>
                            </div>
                            <div class="error"></div>
                        </div>
                        <button type="button" class="btn btn-normal btn-outline btn-iconOnly delete-desc">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                            </svg>
                        </button>
                    </div>';
                }

                if ($description['type'] == '3') {
                    echo '
                        <div>
                            <div class="">
                                <div class="group-input" style="flex: 1">
                                    <div class="form-group">
                                        <div class="">
                                            <label for="caption' . $uniqueId . '" class="input-group">
                                                <input id="caption' . $uniqueId . '" class="p-md" placeholder="Nhập caption" name="caption[]"
                                                    value="' . $description['caption'] . '" autocomplete="off">
                                                <label for="caption' . $uniqueId . '" class="sm input-required">
                                                    Caption
                                                </label>
                                            </label>
                                        </div>
                                        <div class="error"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for=upload-image' . $uniqueId . '" class="sm input-required">Chọn 1 ảnh</label>
                                    <label for=upload-image' . $uniqueId . '" class="flex align-center">
                                        <div class="flex align-center gap-16">
                                            <input type="file" id="upload-image' . $uniqueId . '" name="image[]" data-type="3">
                                            <input type="hidden" name="type[]" value="3">
                                            <label for="upload-image' . $uniqueId . '" class="upload-images-btn btn btn-primary btn-normal">
                                                Choose file
                                            </label>
                                            <div class="preview-image">
                                                <img src="' . $description['image_url'] . '" alt="Preview Image">
                                            </div>
                                        </div>
                                    </label>
                                <div class="error"></div>
                            </div>

                            <button type="button" class="btn btn-normal btn-outline btn-iconOnly delete-desc">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                </svg>
                            </button>
                        </div>
                    ';
                }
            }
            ?>

            <div class="actions">
                <button type="submit" class="btn btn-normal btn-primary submitForm">
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