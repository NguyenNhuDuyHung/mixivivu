<div class="User-page">
    <div class="User-page-container">
        <div class="User-page-title">Danh sách người dùng</div>

        <div class="flex User-page-action">
            <a href="<?= _WEB_ROOT ?>/backend/user/create">
                <button type="button" class="btn btn-normal btn-primary">Tạo người dùng</button>
            </a>

            <form class="User-page-action-search search-box-input-group" method="get"
                action="<?= _WEB_ROOT ?>/backend/user" id="UserSearchForm">
                <div class="search-box-search-input User-search-box-search-input">
                    <label for="" class="input-group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                stroke="var(--gray-400, #98a2b3)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                        </svg>
                        <input class="p-md" type="text" name="keyword" placeholder="Tìm kiếm email, tên người dùng" value="" autocomplete="off">
                    </label>
                </div>
            </form>
        </div>
        <div class="User-page-content">
            <div class="User-page-content-item">
                <div class="User-page-content-item-body">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $startNumber = ($currentPage - 1) * $data['recordsPerPage'] + 1;
                            ?>
                            <?php foreach ($data['users'] as $index => $user):
                                $count++ ?>
                                <tr>
                                    <td><?= $startNumber + $index ?></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['role'] ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0 16px;">
                                            <a href="<?= _WEB_ROOT ?>/backend/user/update/<?= $user['id'] ?>">
                                                <button class="btn btn-normal btn-outline btn-iconOnly">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path
                                                            d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z" />
                                                    </svg>
                                                </button>
                                            </a>
                                            <a href="<?= _WEB_ROOT ?>/backend/user/delete/<?= $user['id'] ?>">
                                                <button class="btn btn-normal btn-outline btn-iconOnly">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path
                                                            d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="flex justify-between align-center Pagination-pagination">
            <div class="flex align-center gap-8 Pagination-left-pagination">
                <p class="sm">Đang xem:</p>
                <div>
                    <label class="md Pagination-page-size">
                        <input max="20" min="1" value="<?php echo $count ?>" type="number">
                    </label>
                </div>

                <p class="sm">của <?= $data['countAllUser'] ?></p>
            </div>

            <ul class="Pagination-pagination-container">
                <li class="Pagination-pagination-left-item Pagination-pagination-item Pagination-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M4.16602 10H15.8327M4.16602 10L9.16602 5M4.16602 10L9.16602 15"
                            stroke="var(--gray-800, #1d2939)" stroke-width="1.67" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                    <div class="sm">Trước</div>
                </li>

                <?php for ($i = 1; $i <= $data['numberPage']; $i++): ?>
                    <li class="Pagination-pagination-item <?= $data['currentPage'] == $i ? 'Pagination-selected' : '' ?>">
                        <a href="<?= _WEB_ROOT ?>/backend/user/page/<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="Pagination-pagination-right-item
                                        Pagination-pagination-item Pagination-disabled">
                    <div class="sm">Tiếp</div>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
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