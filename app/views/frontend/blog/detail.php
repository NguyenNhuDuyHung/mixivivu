<div class="flex flex-col gap-80">
    <div class="BlogDetail-breadcrumbsWrapper">
        <div class="container BlogDetail-breadcrumbs">
            <div class="BreadCrumbs-breadCrumbsContainer">
                <div class="BreadCrumbs-breadcrumb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
                        <path
                            d="M8 17H16M11.0177 2.76401L4.23539 8.03914C3.78202 8.39176 3.55534 8.56807 3.39203 8.78887C3.24737 8.98446 3.1396 9.2048 3.07403 9.43907C3 9.70353 3 9.99071 3 10.5651V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.0799 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V10.5651C21 9.99071 21 9.70353 20.926 9.43907C20.8604 9.2048 20.7526 8.98446 20.608 8.78887C20.4447 8.56807 20.218 8.39176 19.7646 8.03914L12.9823 2.76401C12.631 2.49076 12.4553 2.35413 12.2613 2.30162C12.0902 2.25528 11.9098 2.25528 11.7387 2.30162C11.5447 2.35413 11.369 2.49076 11.0177 2.76401Z"
                            stroke="var(--gray-600, #475467)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <a href="<?= _WEB_ROOT ?>/blog">
                    <div class="BreadCrumbs-breadCrumbs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path d="M9 6L15 12L9 18" stroke="var(--gray-300, #d0d5dd)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        <div class="BreadCrumbs-breadcrumb">Blogs</div>
                    </div>
                </a>
                <a href="<?= _WEB_ROOT ?>/blog-detail/<?= $blog['slug'] ?>">
                    <div class="BreadCrumbs-breadCrumbs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path d="M9 6L15 12L9 18" stroke="var(--gray-300, #d0d5dd)" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        <div class="BreadCrumbs-breadcrumb  BreadCrumbs-selected"><?= $blog['title'] ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container BlogDetail-wrapper">
        <div class="flex flex-col gap-40">
            <div class="SectionHeader-sectionHeader">
                <div class="SectionHeader-title">
                    <h4>
                        <div class="flex flex-col gap-16">
                            <h5><?= $blog['title'] ?></h5>
                            <div class="Badge-default  Badge-sm Badge-container">
                                <label class="xs"><?= $blog['created_at'] ?></label>
                            </div>
                        </div>
                    </h4>
                    <div>
                        <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;">

                            <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;">
                                <img alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2780%27%20height=%278%27/%3e" style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">
                            </span>
                            <img src="https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75" decoding="async" data-nimg="intrinsic" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" srcset="https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75 1x, https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75 2x">
                            <noscript></noscript>
                        </span>
                    </div>
                </div>
            </div>
            <p style="font-style: italic; color: var(--gray-600, #475467);"><?= $blog['short_desc'] ?></p>
        </div>
    </div>

    <div class="container flex flex-col gap-40 BlogDetail-wrapper">
        <div class="BlogDetail-thumbnail" style="width: 100%; height: 568px; position: relative; overflow: hidden;">
            <img alt="mixivivu" src="<?= $blog['thumbnail'] ?>" width="100%" height="100%" loading="lazy" style="object-fit: cover;">
        </div>
        <div class="BlogDetail-output">
            <?php foreach ($longDescBlog as $value): ?>
                <?php
                if ($value['type'] == 2) {
                    echo '
                      <p class="" style="margin: 5px 0px; text-align: left;">
                        ' . $value['text'] . '
                    </p>
                    ';
                }

                if($value['type'] == 3) {
                    echo '
                    <figure class="" style="position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 20px 0px; width: 100%; max-width: 100%; max-height: 400px; overflow: hidden; border: none;">
                        <img src="' . $value['image_url'] . '" alt="" class="" style="max-width: 100%; max-height: 400px;">
                    </figure>
                    ';
                }

                if($value['type'] == 4) {
                    echo '
                        <ul style="margin: 5px 0px;">
                            <li class="">' . $value['text'] . '</li>
                        </ul>
                    ';
                }
                ?>
                
            <?php endforeach; ?>
        </div>
    </div>


</div>