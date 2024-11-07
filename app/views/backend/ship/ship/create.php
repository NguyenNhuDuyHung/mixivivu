<div class="action-page">
    <form method="post" action="" id="CruiseCreateForm">
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