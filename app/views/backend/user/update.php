<div class="User-action-page">
    <form method="post" action="" id="UserUpdateForm">
        <div class="User-modal">
            <h6>Chỉnh sửa thông tin người dùng</h6>
            <div class="divider" style="border-bottom: 1px solid var(--gray-200, #eaecf0);"></div>

            <div class="User-group-input">
                <div class="form-group">
                    <div class="">
                        <label for="name" class="input-group">
                            <input id="name" class="p-md" placeholder="Nhập họ và tên" name="name"
                                value="<?php echo $this->oldInfo('name', $data) ?? $data['user']['name']; ?>"
                                autocomplete="off">
                            <label for="name" class="sm input-required">
                                Name
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="email" class="input-group">
                            <input id="email" class="p-md" placeholder="Nhập email" name="email"
                                value="<?php echo $this->oldInfo('email', $data) ?? $data['user']['email']; ?>"
                                autocomplete="off">
                            <label for="email" class="sm input-required">
                                Email
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="User-group-input">
                <div class="form-group">
                    <div class="">
                        <label for="password" class="input-group">
                            <input id="password" class="p-md" placeholder="Nhập họ và tên" name="password"
                                value="<?php echo $this->oldInfo('password', $data) ?? $data['user']['password']; ?>"
                                autocomplete="off" type="password">
                            <label for="password" class="sm input-required">
                                Password
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="phone" class="input-group">
                            <input id="phone" class="p-md" placeholder="Nhập số điện thoại" name="phone"
                                value="<?php echo $this->oldInfo('phone', $data) ?? $data['user']['phone']; ?>"
                                autocomplete="off">
                            <label for="phone" class="sm input-required">
                                Phone
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="User-group-input">
                <div class="form-group">
                    <div class="role-select-input">
                        <label for="role" class="input-group">
                            <input id="role" class="p-md" placeholder="Chọn vai trò" name="role" value="<?php
                            echo $this->oldInfo('role', $data) ??
                                ($data['user']['user_catalogue_id'] == 1 ? 'Quản trị viên' : 'Cộng tác viên');
                            ?>" autocomplete="off">
                            <label for="role" class="sm input-required">
                                Role
                            </label>
                        </label>

                        <div class="role-dropdown">
                            <div class="role-dropdown-item" value="Quản trị viên">
                                Quản trị viên
                            </div>
                            <div class="role-dropdown-item" value="Cộng tác viên">
                                Cộng tác viên
                            </div>
                        </div>
                    </div>
                    <div class="error"></div>
                </div>
            </div>

            <div class="User-actions">
                <button type="submit" class="btn btn-normal btn-primary">
                    <div class="label md">Update</div>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        var message = "<?php echo isset($_SESSION['toast-error']) ? $_SESSION['toast-error'] : ''; ?>";
        if (message) {
            toastr.error(message);
        }
        <?php $this->model->removeSession('toast-error'); ?>
    });
</script>

<script>
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const roleSelect = $('input[id="role"]');
    const roleDropdownItemList = $$('.role-dropdown-item');

    roleDropdownItemList.forEach(item => {
        item.addEventListener('mousedown', () => {
            roleSelect.value = item.getAttribute('value');
        });
    });
</script>