<div class="action-page">
    <form method="post" action="" id="RoomCreateForm" enctype="multipart/form-data">
        <div class="modal rooms">
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

                <div class="form-group">
                    <div class="">
                        <label for="title" class="input-group">
                            <input id="title" class="p-md" placeholder="Tên phòng" name="title"
                                value="<?php echo $this->oldInfo('title', $data) ?>" autocomplete="off">
                            <label for="title" class="sm input-required">
                                Tên phòng
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="size" class="input-group">
                            <input id="size" class="p-md" placeholder="Size" name="size"
                                value="<?php echo $this->oldInfo('size', $data) ?>" autocomplete="off">
                            <label for="size" class="sm input-required">
                                Size
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="max_persons" class="input-group">
                            <input id="max_persons" class="p-md" placeholder="MaxPersons" name="max_persons"
                                value="<?php echo $this->oldInfo('max_persons', $data) ?>" autocomplete="off">
                            <label for="max_persons" class="sm input-required">
                                MaxPersons
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>


            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="price" class="input-group">
                            <input id="price" class="p-md" placeholder="Price" name="price"
                                value="<?php echo $this->oldInfo('price', $data) ?>" autocomplete="off">
                            <label for="price" class="sm input-required">
                                Price
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="sale_prices" class="input-group">
                            <input id="sale_prices" class="p-md" placeholder="SalePrices" name="sale_prices"
                                value="<?php echo $this->oldInfo('sale_prices', $data) ?>" autocomplete="off">
                            <label for="sale_prices" class="sm input-required">
                                SalePrices
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="bed_type" class="input-group">
                            <input id="bed_type" class="p-md" placeholder="Loại giường" name="bed_type"
                                value="<?php echo $this->oldInfo('bed_type', $data) ?>" autocomplete="off">
                            <label for="bed_type" class="sm">
                                Loại giường
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="view" class="input-group">
                            <input id="view" class="p-md" placeholder="View" name="view"
                                value="<?php echo $this->oldInfo('view', $data) ?>" autocomplete="off">
                            <label for="view" class="sm">
                                View
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="">
                <div class="form-group">
                    <label for="upload-image" class="sm input-required">Chọn album ảnh</label>
                    <div class="">
                        <label for="upload-image" class="flex align-center">
                            <div class="flex align-center gap-16">
                                <input type="file" id="upload-image" name="images[]" multiple>
                                <label for="upload-image" class="upload-images-btn btn btn-primary btn-normal">
                                    Choose file
                                </label>
                                <div class="preview-image">
                                    <div class="temp-img">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                                            <rect width="100" height="100" rx="5" fill="#E2E6EC" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.6667 37C28.6667 34.6068 30.6068 32.6667 33.0001 32.6667H67.0001C69.3933 32.6667 71.3334 34.6068 71.3334 37V63.6667C71.3334 66.0599 69.3933 68 67.0001 68H33.0001C30.6068 68 28.6667 66.0599 28.6667 63.6667V37ZM33.0001 34.6667C31.7114 34.6667 30.6667 35.7113 30.6667 37V63.6667C30.6667 64.9553 31.7114 66 33.0001 66H67.0001C68.2887 66 69.3334 64.9553 69.3334 63.6667V37C69.3334 35.7113 68.2887 34.6667 67.0001 34.6667H33.0001Z" fill="#B2B9C4" />
                                            <ellipse cx="38.6668" cy="42" rx="4.33333" ry="4.33333" fill="#B2B9C4" />
                                            <path d="M34.3335 60.3333V58.357C34.3335 57.915 34.5091 57.4911 34.8217 57.1785L40.2098 51.7904C40.8389 51.1613 41.8511 51.1372 42.5094 51.7357L43.8407 52.946C44.4923 53.5383 45.4923 53.5216 46.1236 52.9077L55.8219 43.4789C56.4753 42.8436 57.5178 42.851 58.1622 43.4954L65.8453 51.1785C66.1579 51.4911 66.3335 51.915 66.3335 52.357V60.3333C66.3335 61.2538 65.5873 62 64.6668 62H36.0002C35.0797 62 34.3335 61.2538 34.3335 60.3333Z" fill="#B2B9C4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="select-feature">
                <?php foreach ($data['roomFeatures'] as $roomFeature): ?>
                    <label for="<?= $roomFeature['id'] ?>" class="Checkbox-container">
                        <input name="roomFeatures[]" type="checkbox" id="<?= $roomFeature['id'] ?>" value="<?= $roomFeature['id'] ?>">
                        <span class="Checkbox-checkmark Checkbox-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <div class="Chechbox-textGroup">
                            <div class="sm Chechbox-title label"><?= $roomFeature['text'] ?></div>
                            <p class="sm"></p>
                        </div>
                    </label>
                <?php endforeach; ?>
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