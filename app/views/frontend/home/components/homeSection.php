<section class="container home-section">
    <div class="SectionHeader-sectionHeader SectionHeader-center">
        <div class="SectionHeader-title">
            <h4>Các điểm đến của Mixivivu</h4>
        </div>
        <label for="" class="lg SectionHeader-description">
            Khám phá vẻ đẹp tuyệt vời của Du thuyền Hạ Long: Hành trình đến thiên đường thiên nhiên
        </label>
        <div>
            <span
                style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                <span
                    style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;">
                    <img alt="" aria-hidden="true"
                        src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2780%27%20height=%278%27/%3e"
                        style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">
                </span>
                <img srcset="<?php echo _WEB_ROOT ?>/public/img/heading-border.webp 1x, <?php echo _WEB_ROOT ?>/public/img/heading-border.web 2x"
                    src="<?php echo _WEB_ROOT ?>/public/img/headin g-border.webp 1x, <?php echo _WEB_ROOT ?>/public/img/heading-border.web 2x"
                    decoding="async" data-nimg="intrinsic"
                    style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
            </span>
        </div>
    </div>

    <div class="home-cardList">
        <?php foreach ($cruiseCategories as $cruiseCategory): ?>
            <a href="#">
                <div class="card CategoryCard-categoryCard">
                    <div class="CategoryCard-imageWrapper">
                        <div style="width:100%;height:100%;position:relative;overflow:hidden">
                            <img alt="mixivivu"
                                src="<?= $cruiseCategory['image'] ?>"
                                width="100%" height="100%" loading="lazy" style="object-fit:cover">
                        </div>
                    </div>
                    <div class="CategoryCard-body">
                        <h6><?= $cruiseCategory['name'] ?></h6>
                    </div>
                    <div class="CategoryCard-footer">
                        <button type="button" class="btn btn-sm btn-outline">
                            <div class="label sm">
                                Xem ngay
                            </div>
                        </button>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</section>