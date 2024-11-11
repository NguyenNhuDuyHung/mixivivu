<div class="action-page">
    <form method="post" action="" id="CruiseCreateForm" enctype="multipart/form-data">
        <div class="modal">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="title" class="input-group">
                            <input id="title" class="p-md" placeholder="Nhập tiêu đề" name="title"
                                value="<?php echo $this->oldInfo('title', $data) ?>" autocomplete="off">
                            <label for="title" class="sm input-required">
                                Tiêu đề
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="address" class="input-group">
                            <input id="address" class="p-md" placeholder="Nhập địa chỉ" name="address"
                                value="<?php echo $this->oldInfo('address', $data) ?>" autocomplete="off">
                            <label for="address" class="sm input-required">
                                Địa chỉ
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input-4">
                <div class="form-group">
                    <div class="">
                        <label for="shell" class="input-group">
                            <input id="shell" class="p-md" placeholder="Nhập vật liệu thân vỏ" name="shell"
                                value="<?php echo $this->oldInfo('shell', $data) ?>" autocomplete="off">
                            <label for="shell" class="sm input-required">
                                Thân vỏ
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="year" class="input-group">
                            <input id="year" class="p-md" placeholder="Nhập năm hạ thủy" name="year"
                                value="<?php echo $this->oldInfo('year', $data) ?>" autocomplete="off">
                            <label for="year" class="sm input-required">
                                Năm hạ thủy
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="cabin" class="input-group">
                            <input id="cabin" class="p-md" placeholder="Nhập số lượng cabin" name="cabin"
                                value="<?php echo $this->oldInfo('cabin', $data) ?>" autocomplete="off">
                            <label for="cabin" class="sm input-required">
                                Cabin
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="admin" class="input-group">
                            <input id="admin" class="p-md" placeholder="Nhập tên công ty điều hành" name="admin"
                                value="<?php echo $this->oldInfo('admin', $data) ?>" autocomplete="off">
                            <label for="admin" class="sm input-required">
                                Tên công ty điều hành
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="map_link" class="input-group">
                            <input id="map_link" class="p-md" placeholder="Nhập link bản đồ google map" name="map_link"
                                value="<?php echo $this->oldInfo('map_link', $data) ?>" autocomplete="off"
                                type="text">
                            <label for="map_link" class="sm input-required">
                                Map Link
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="map_iframe_link" class="input-group">
                            <input id="map_iframe_link" class="p-md" placeholder="Nhập link nhúng bản đồ google map cho thẻ iframe" name="map_iframe_link"
                                value="<?php echo $this->oldInfo('map_iframe_link', $data) ?>" autocomplete="off">
                            <label for="map_iframe_link" class="sm input-required">
                                Map Iframe Link
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="schedule" class="input-group">
                            <input id="schedule" class="p-md" placeholder="Nhập lịch trình. Ví dụ: 2 ngày 1 đêm." name="schedule"
                                value="<?php echo $this->oldInfo('schedule', $data) ?>" autocomplete="off">
                            <label for="schedule" class="sm input-required">
                                Lịch trình
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="trip" class="input-group">
                            <input id="trip" class="p-md" placeholder="Nhập hành trình. Ví dụ: Vịnh Lan Hạ - Bãi tắm Ba Trái Đào - Hang Sáng Tối" name="trip"
                                value="<?php echo $this->oldInfo('trip', $data) ?>" autocomplete="off">
                            <label for="trip" class="sm input-required">
                                Hành trình
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input-4">
                <div class="form-group">
                    <div class="">
                        <label for="slug" class="input-group">
                            <input id="slug" class="p-md" placeholder="Slug" name="slug"
                                value="<?php echo $this->oldInfo('slug', $data) ?>" autocomplete="off"
                                type="text">
                            <label for="slug" class="sm input-required">
                                Slug
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="select-input">
                        <label for="type_product" class="input-group">
                            <input id="type_product" class="p-md" placeholder="Chọn vai trò" name="type_product"
                                value="<?php echo $this->oldInfo('type_product', $data) ?>" autocomplete="off">
                            <label for="type_product" class="sm input-required">
                                Loại sản phẩm
                            </label>
                        </label>

                        <div class="dropdown">
                            <?php foreach ($data['type_products'] as $type_product): ?>
                                <div class="dropdown-item" value="<?php echo $type_product['name'] ?>">
                                    <?php echo $type_product['name'] ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="select-input">
                        <label for="active" class="input-group">
                            <input id="active" class="p-md" placeholder="Chọn kích hoạt" name="active"
                                value="<?php echo $this->oldInfo('active', $data) ?>" autocomplete="off">
                            <label for="active" class="sm input-required">
                                Kích hoạt
                            </label>
                        </label>

                        <div class="dropdown">
                            <div class="dropdown-item" value="Kích hoạt">
                                Kích hoạt
                            </div>
                            <div class="dropdown-item" value="Không kích hoạt">
                                Không kích hoạt
                            </div>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="select-input">
                        <label for="category_id" class="input-group">
                            <input id="category_id" class="p-md" placeholder="Chọn danh mục" name="category_id"
                                value="<?php echo $this->oldInfo('category_id', $data) ?>" autocomplete="off">
                            <label for="category_id" class="sm input-required">
                                Chọn danh mục du thuyền
                            </label>
                        </label>

                        <div class="dropdown">
                            <?php
                            foreach ($data['cruise_categories'] as $cruise_category): ?>
                                <div class="dropdown-item" value="<?= $cruise_category['name'] ?>">
                                    <?= $cruise_category['name'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="">
                <div class="form-group">
                    <label for="upload-thumbnail" class="sm input-required">Chọn thumbnail</label>
                    <div class="">
                        <label for="upload-thumbnail" class="flex align-center">
                            <div class="flex align-center gap-16">
                                <input type="file" id="upload-thumbnail" name="thumbnail[]">
                                <label for="upload-thumbnail" class="upload-thumb-btn btn btn-primary btn-normal">
                                    Choose file
                                </label>
                                <div class="preview-thumb">
                                    <div class="temp-thumb">
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

            <div class="">
                <div class="form-group">
                    <label for="upload-image" class="sm input-required">Chọn album ảnh(sẽ được hiển thị trong slider)(upload tối đa 10 ảnh 1 lần, tránh quá tải server)</label>
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