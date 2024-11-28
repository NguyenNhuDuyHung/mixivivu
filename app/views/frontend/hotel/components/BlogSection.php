<section class="container BlogSection-section">
    <div class="SectionHeader-sectionHeader">
        <div class="SectionHeader-title">
            <h4>
                Khám phá Sự đặc sắc
                <br> và Cập nhật tin tức mới nhất
            </h4>
            <div>
                <span
                    style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                    <span
                        style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;">
                        <img alt="" aria-hidden="true"
                            src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2780%27%20height=%278%27/%3e"
                            style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">
                    </span>
                    <img srcset="<?= _WEB_ROOT?>/public/img/heading-border.webp 1x, <?= _WEB_ROOT?>/public/img/heading-border.web 2x"
                        src="<?= _WEB_ROOT?>/public/img/heading-border.webp 1x, <?= _WEB_ROOT?>/public/img/heading-border.web 2x"
                        decoding="async" data-nimg="intrinsic"
                        style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                </span>
            </div>
        </div>
        <label for="" class="lg SectionHeader-description">
            Những điểm đến hấp dẫn cùng nhiều thông tin cần thiết cho chuyến du lịch tuyệt vời của bạn.
        </label>
    </div>

    <div class="BlogSection-cardList">
        <?php foreach ($hotelBlog as $blog) : ?>
            <a href="<?= _WEB_ROOT ?>/blog-detail/<?= $blog['slug'] ?>">
                <div class="card BlogCard-blogCard">
                    <div class="BlogCard-imageWrapper">
                        <div class="BlogCard-imageWrapper-image"
                            style="width: 352px; height: 216px; position: relative; overflow: hidden;">
                            <img alt="mixivivu"
                                src="<?= $blog['thumbnail'] ?>"
                                width="100%" height="100%" loading="lazy" style="object-fit: cover;">
                        </div>
                    </div>

                    <div class="BlogCard-body">
                        <p class="subheading md BlogCard-title"><?= $blog['title'] ?></p>
                        <p class="BlogCard-description sm">
                            <?= $blog['short_desc'] ?>
                        </p>
                    </div>

                    <p class="BlogCard-footer detail sm"><?= $blog['created_at'] ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="BlogSection-action">
        <a href="<?= _WEB_ROOT ?>/blog">
            <button type="button" class="btn btn-normal btn-outline">
                <div class="label md">
                    Xem tất cả
                </div>
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>
        </a>
    </div>
</section>