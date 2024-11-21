<div class="action-page">
    <form method="post" action="" id="BlogUpdateForm" enctype="multipart/form-data">
        <div class="modal">
            <h6><?php echo $data['page_title']; ?></h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="title" class="input-group">
                            <input id="title" class="p-md" placeholder="Nhập tiêu đề" name="title"
                                value="<?php echo $this->oldInfo('title', $data) ?? $data['blog']['title'] ?>" autocomplete="off">
                            <label for="title" class="sm input-required">
                                Tiêu đề
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="short_desc" class="input-group">
                            <input id="short_desc" class="p-md" placeholder="Nhập mô tả ngắn" name="short_desc"
                                value="<?php echo $this->oldInfo('short_desc', $data) ?? $data['blog']['short_desc'] ?>" autocomplete="off">
                            <label for="short_desc" class="sm input-required">
                                ShortDesc
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="group-input">
                <div class="form-group">
                    <div class="">
                        <label for="slug" class="input-group">
                            <input id="slug" class="p-md" placeholder="Slug" name="slug"
                                value="<?php echo $this->oldInfo('slug', $data) ?? $data['blog']['slug'] ?>" autocomplete="off"
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
                        <label for="type_blog" class="input-group">
                            <input id="type_blog" class="p-md" placeholder="Chọn vai trò" name="type_blog"
                                value="<?php echo $this->oldInfo('type_blog', $data) ?? $data['blog']['type_name'] ?>" autocomplete="off">
                            <label for="type_blog" class="sm input-required">
                                Loại blog
                            </label>
                        </label>

                        <div class="dropdown">
                            <?php foreach ($data['type_blogs'] as $type_blog): ?>
                                <div class="dropdown-item" value="<?php echo $type_blog['type'] ?>">
                                    <?php echo $type_blog['type'] ?>
                                </div>
                            <?php endforeach ?>
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
                                    <?php
                                    if (!empty($data['blog']['thumbnail'])) {
                                        echo '<img class="preview-upload-image" src="'  . $data['blog']['thumbnail'] . '" alt="">';
                                    } else {
                                        echo '<div class="temp-thumb"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                                            <rect width="100" height="100" rx="5" fill="#E2E6EC" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.6667 37C28.6667 34.6068 30.6068 32.6667 33.0001 32.6667H67.0001C69.3933 32.6667 71.3334 34.6068 71.3334 37V63.6667C71.3334 66.0599 69.3933 68 67.0001 68H33.0001C30.6068 68 28.6667 66.0599 28.6667 63.6667V37ZM33.0001 34.6667C31.7114 34.6667 30.6667 35.7113 30.6667 37V63.6667C30.6667 64.9553 31.7114 66 33.0001 66H67.0001C68.2887 66 69.3334 64.9553 69.3334 63.6667V37C69.3334 35.7113 68.2887 34.6667 67.0001 34.6667H33.0001Z" fill="#B2B9C4" />
                                            <ellipse cx="38.6668" cy="42" rx="4.33333" ry="4.33333" fill="#B2B9C4" />
                                            <path d="M34.3335 60.3333V58.357C34.3335 57.915 34.5091 57.4911 34.8217 57.1785L40.2098 51.7904C40.8389 51.1613 41.8511 51.1372 42.5094 51.7357L43.8407 52.946C44.4923 53.5383 45.4923 53.5216 46.1236 52.9077L55.8219 43.4789C56.4753 42.8436 57.5178 42.851 58.1622 43.4954L65.8453 51.1785C66.1579 51.4911 66.3335 51.915 66.3335 52.357V60.3333C66.3335 61.2538 65.5873 62 64.6668 62H36.0002C35.0797 62 34.3335 61.2538 34.3335 60.3333Z" fill="#B2B9C4" />
                                        </svg></div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="actions gap-16">
                <button type="submit" class="btn btn-normal btn-primary">
                    <div class="label md">Tạo</div>
                </button>

                <a href="<?php echo _WEB_ROOT . '/backend/blog/update/long-desc/' . $data['blog']['id']  ?>">
                    <button type="button" class="btn btn-normal btn-outline">
                        <div class="label md">Cập nhật mô tả chi tiết</div>
                    </button>
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var errorMessage = "<?php echo isset($_SESSION['toast-error']) ? $_SESSION['toast-error'] : ''; ?>";
        var successMessage = "<?php echo isset($_SESSION['toast-success']) ? $_SESSION['toast-success'] : ''; ?>";

        if (errorMessage) {
            toastr.error(errorMessage);
        }

        if (successMessage) {
            toastr.success(successMessage);
        }
        <?php $this->model->removeSession('toast-error'); ?>
        <?php $this->model->removeSession('toast-success'); ?>
    });
</script>