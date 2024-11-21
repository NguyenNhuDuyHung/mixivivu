<div class="BlogPage-blog-page container flex flex-col gap-80">
    <div class="BlogPage-blog-header flex justify-betwee gap-16">
        <div class="SectionHeader-sectionHeader SectionHeader-column">
            <div class="SectionHeader-title">
                <h4>
                    Hạ Long: Khám phá Sự đặc sắc
                    <br>
                    và Cập nhật tin tức mới nhất
                </h4>
            </div>
            <label class=" lg SectionHeader-description">
                Hạ Long: Bí mật và Cuộc sống trong Vịnh - Khám phá và Cập nhật những tin tức hấp dẫn từ điểm đến tuyệt vời này.
            </label>

            <div>
                <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                    <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;">
                        <img alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2780%27%20height=%278%27/%3e" style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">
                    </span>
                    <img src="https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75" decoding="async" data-nimg="intrinsic" srcset="https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75 1x, https://mixivivu.com/_next/image?url=%2Fheading-border.png&amp;w=256&amp;q=75 2x" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                </span>
            </div>
        </div>
    </div>
<!-- 
    <div>
        <div class="Tabs-tabs-header">
            <div>
                <button type="button" class="Tabs-tabItem Tabs-sm Tabs-active ">
                    <label>Tất cả</label>
                </button>
            </div>
            <div>
                <button type="button" class="Tabs-tabItem Tabs-sm  ">
                    <label>Du lịch</label>
                </button>
            </div>
            <div>
                <button type="button" class="Tabs-tabItem Tabs-sm  ">
                    <label>Khách sạn</label>
                </button>
            </div>
            <div>
                <button type="button" class="Tabs-tabItem Tabs-sm  ">
                    <label>Du thuyền</label>
                </button>
            </div>
        </div>
    </div> -->

    <div class="BlogPage-blog-list">
        <?php
        $count = 0;
        $startNumber = ($currentPage - 1) * $data['recordsPerPage'] + 1;
        ?>
        <?php foreach ($blogs as $blog) :
            $count++; ?>

            <a href="<?= _WEB_ROOT ?>/blog-detail/<?= $blog['slug'] ?>">
                <div class="Card-card BlogCard-blogCard">
                    <div class="BlogCard-imageWrapper">
                        <div class="BlogCard-imageWrapper-image" style="width: 352px; height: 216px; position: relative; overflow: hidden;">
                            <img alt="mixivivu" src="<?= $blog['thumbnail'] ?>" width="100%" height="100%" loading="lazy" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="BlogCard-body">
                        <p class="subheading md BlogCard-title"><?= $blog['title'] ?></p>
                        <p class="BlogCard-description sm"><?= $blog['short_desc'] ?></p>
                    </div>
                    <p class="BlogCard-footer detail sm"><?= $blog['created_at'] ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="flex justify-between align-center Pagination-pagination">
        <div class="flex align-center gap-8 Pagination-left-pagination">
            <p class="sm">Đang xem:</p>
            <div>
                <label class="md Pagination-page-size">
                    <input max="20" min="1" value="<?php echo $count ?>" type="number">
                </label>
            </div>

            <p class="sm">của <?= $data['countAll'] ?></p>
        </div>

        <ul class="Pagination-pagination-container">
            <a href="<?= _WEB_ROOT ?>/blog<?= isset($_GET['keyword']) ? '/search?keyword=' . $_GET['keyword'] . '&page=' . $data['currentPage'] - 1 : '/page/' . $data['currentPage'] - 1;
                                            ?>"
                class="Pagination-pagination-left-item Pagination-pagination-item <?= $data['currentPage'] == 1 ? 'Pagination-disabled' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M4.16602 10H15.8327M4.16602 10L9.16602 5M4.16602 10L9.16602 15"
                        stroke="var(--gray-800, #1d2939)" stroke-width="1.67" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
                <div class="sm">Trước</div>
            </a>

            <?php for ($i = 1; $i <= $data['numberPage']; $i++): ?>
                <a href="<?= _WEB_ROOT ?>/blog<?= isset($_GET['keyword']) ? '/search?keyword=' . $_GET['keyword'] . '&page=' . $i : '/page/' . $i ?>"
                    class="Pagination-pagination-item <?= $data['currentPage'] == $i ? 'Pagination-selected' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <a href="<?= _WEB_ROOT ?>/blog<?= isset($_GET['keyword']) ? '/search?keyword=' . $_GET['keyword'] . '&page=' . $data['currentPage'] + 1 : '/page/' . $data['currentPage'] + 1 ?>"
                class="Pagination-pagination-right-item
                                        Pagination-pagination-item <?= $data['currentPage'] == $data['numberPage'] ? 'Pagination-disabled' : '' ?>">
                <div class="sm">Tiếp</div>
                <svg width="20" height="20" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        </ul>
    </div>
</div>