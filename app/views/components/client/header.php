<div class="header-wrapper home-header">
    <div class="container flex justify-between align-center header-container">
        <div class="flex align-center gap-40 h-full">
            <div class="header-logo">
                <a href="<?= _WEB_ROOT ?>">
                    <span
                        style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                        <span
                            style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                            <img style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0"
                                alt="" aria-hidden="true"
                                src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27156%27%20height=%2742%27/%3e">
                        </span>
                        <img src="<?php echo _WEB_ROOT ?>/public/img/black-logo.webp" decoding="async"
                            data-nimg="intrinsic"
                            style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                            srcset="<?php echo _WEB_ROOT ?>/public/img/black-logo.webp 1x, <?php echo _WEB_ROOT ?>/public/img/black-logo.webp 2x">
                    </span>
                </a>
            </div>

            <ul class="flex gap-24 h-full align-center cursor-pointer header-nav-container">
                <a href="<?php echo _WEB_ROOT ?>/tim-du-thuyen" class="header-menu h-full flex align-center">
                    <label for="" class="md">Tìm du thuyền</label>
                </a>

                <a href="<?php echo _WEB_ROOT ?>/khach-san" class="header-menu h-full flex align-center">
                    <label for="" class="md">Tìm khách sạn</label>
                </a>

                <a href="<?php echo _WEB_ROOT ?>/doanh-nghiep" class="header-menu h-full flex align-center">
                    <label for="" class="md">Doanh nghiệp</label>
                </a>

                <a href="<?php echo _WEB_ROOT ?>/blog" class="header-menu h-full flex align-center">
                    <label for="" class="md">Blog</label>
                </a>
            </ul>
        </div>
        <div class="flex gap-16 align-center">
            <div class="header-phone">
                <div class="header-phone-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M21.384,17.752a2.108,2.108,0,0,1-.522,3.359,7.543,7.543,0,0,1-5.476.642C10.5,20.523,3.477,13.5,2.247,8.614a7.543,7.543,0,0,1,.642-5.476,2.108,2.108,0,0,1,3.359-.522L8.333,4.7a2.094,2.094,0,0,1,.445,2.328A3.877,3.877,0,0,1,8,8.2c-2.384,2.384,5.417,10.185,7.8,7.8a3.877,3.877,0,0,1,1.173-.781,2.092,2.092,0,0,1,2.328.445Z">
                        </path>
                    </svg>
                </div>
                <a href="tel:0922222016">Hotline: 0922222016</a>
            </div>

            <a href="<?php echo _WEB_ROOT ?>/lien-he">
                <button type="button" class="btn btn-primary btn-sm btn-contact">
                    <div class="label sm">Liên hệ Mixivivu</div>
                </button>
            </a>

            <div class="header-menu-mb">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M4 7C4 5.34315 5.34315 4 7 4C8.65685 4 10 5.34315 10 7C10 8.65685 8.65685 10 7 10C5.34315 10 4 8.65685 4 7Z"
                            stroke="#1D2939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M14 7C14 5.34315 15.3431 4 17 4C18.6569 4 20 5.34315 20 7C20 8.65685 18.6569 10 17 10C15.3431 10 14 8.65685 14 7Z"
                            stroke="#1D2939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M14 17C14 15.3431 15.3431 14 17 14C18.6569 14 20 15.3431 20 17C20 18.6569 18.6569 20 17 20C15.3431 20 14 18.6569 14 17Z"
                            stroke="#1D2939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path
                            d="M4 17C4 15.3431 5.34315 14 7 14C8.65685 14 10 15.3431 10 17C10 18.6569 8.65685 20 7 20C5.34315 20 4 18.6569 4 17Z"
                            stroke="#1D2939" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                    </svg>
                </div>
            </div>

            <div style="display: none;" class="Dropdown-dropdown header-menu-mb-content">
                <div class="header-menu-mb-nav-item">
                    <label for="" class="md">Tìm du thuyền</label>
                </div>

                <div class="header-menu-mb-nav-item">
                    <label for="" class="md">Tìm vé máy bay</label>
                </div>

                <div class="header-menu-mb-nav-item">
                    <label for="" class="md">Doanh nghiệp</label>
                </div>

                <div class="header-menu-mb-nav-item">
                    <label for="" class="md">Blog</label>
                </div>

                <div class="header-menu-mb-nav-item">
                    <a href="tel:0922222016">
                        <label for="" class="md">Hotline: 0922222016</label>
                    </a>
                </div>

                <div class="header-menu-mb-nav-item">
                    <a href="mailto:info@mixivivu.com">
                        <label for="" class="md">Email: info@mixivivu.com</label>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>