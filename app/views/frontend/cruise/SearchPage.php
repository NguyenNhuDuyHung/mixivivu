<div class="SearchPageDetail-search-page flex flex-col gap-80 container">
    <div class="fresnel-container fresnel-greaterThan-mdless ">
        <div class="card SearchPageDetail-search-box SearchBox-searchBox flex flex-col justify-center gap-40">
            <div class="flex flex-col gap-16 gray-900">
                <h4 class="text-center search-box-title">
                    Bạn lựa chọn du thuyền Hạ Long nào?
                </h4>
                <p class="lg text-center search-box-description ">
                    Hơn 100 tour du thuyền hạng sang giá tốt đang chờ bạn
                </p>
            </div>
            <form action="<?= _WEB_ROOT ?>/tim-du-thuyen/search" method="get">
                <div class="flex gap-20 search-box-input-group">
                    <div class="search-box-search-input">
                        <label for="" class="input-group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                    stroke="var(--gray-400, #98a2b3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                            <input class="p-md" type="text" name="keyword" placeholder="Nhập tên du thuyền" value="">
                        </label>
                    </div>
                    <div class="search-box-select-input">
                        <div class="focus-dropdown">
                            <label for="allLocations" class="input-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M5.7 15C4.03377 15.6353 3 16.5205 3 17.4997C3 19.4329 7.02944 21 12 21C16.9706 21 21 19.4329 21 17.4997C21 16.5205 19.9662 15.6353 18.3 15M12 9H12.01M18 9C18 13.0637 13.5 15 12 18C10.5 15 6 13.0637 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9ZM13 9C13 9.55228 12.5523 10 12 10C11.4477 10 11 9.55228 11 9C11 8.44772 11.4477 8 12 8C12.5523 8 13 8.44772 13 9Z"
                                        stroke="var(--gray-400, #98a2b3)" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </svg> <input id="allLocations" class="p-md" type="button" value="Tất cả địa điểm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path d="M6 9L12 15L18 9" stroke="var(--gray-400, #98a2b3)" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <label for="allLocations" class="sm"></label>
                            </label>

                            <div class="search-box-dropdown">
                                <div class="search-box-dropdown-item">
                                    Tất cả địa điểm
                                </div>
                                <div class="search-box-dropdown-item">
                                    Vịnh Hạ Long
                                </div>
                                <div class="search-box-dropdown-item">
                                    Vịnh Lan Hạ
                                </div>
                                <div class="search-box-dropdown-item">
                                    Đảo Cát Bà
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="search-box-select-input">
                        <div class="focus-dropdown">
                            <label for="allPrices" class="input-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M15 10V9.91667C15 8.85812 14.1419 8 13.0833 8H11C9.89543 8 9 8.89543 9 10C9 11.1046 9.89543 12 11 12H13C14.1046 12 15 12.8954 15 14C15 15.1046 14.1046 16 13 16H10.9583C9.87678 16 9 15.1232 9 14.0417V14M12 17.5V6.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                                        stroke="var(--gray-400, #98a2b3)" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </svg>
                                <input id="allPrices" class="p-md" type="button" value="Tất cả mức giá">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path d="M6 9L12 15L18 9" stroke="var(--gray-400, #98a2b3)" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <label for="allPrices" class="sm"></label>
                            </label>

                            <div class="search-box-dropdown">
                                <div class="search-box-dropdown-item">
                                    Tất cả mức giá
                                </div>
                                <div class="search-box-dropdown-item">
                                    Từ 1 đến 3 triệu
                                </div>
                                <div class="search-box-dropdown-item">
                                    Từ 3 đến 6 triệu
                                </div>
                                <div class="search-box-dropdown-item">
                                    Trên 6 triệu
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-normal btn-primary">
                        <div class="label md">Tìm kiếm</div>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="SearchPageDetail-header">
            <div class="SearchPageDetail-title-duiiy">
                <h4>Tìm thấy <?= $data['countAll'] ?> kết quả</h4>
                <span style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;">
                    <span style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;">
                        <img alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2780%27%20height=%278%27/%3e" style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;">
                    </span>
                    <img src="https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75" decoding="async" data-nimg="intrinsic" srcset="https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75 1x, https://mixivivu.com/_next/image?url=%2Fheading-border.png&w=96&q=75 2x" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;">
                    <noscript></noscript>
                </span>
            </div>

            <div class="flex jusstify-between">
                <div class="SearchPageDetail-filter-btn">
                    <button type="button" class="btn btn-btn btn-normal btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                            <path d="M1.91675 3.83333C1.91675 3.36662 1.91675 3.13327 2.00758 2.95501C2.08747 2.79821 2.21495 2.67072 2.37176 2.59083C2.55002 2.5 2.78337 2.5 3.25008 2.5H17.2501C17.7168 2.5 17.9501 2.5 18.1284 2.59083C18.2852 2.67072 18.4127 2.79821 18.4926 2.95501C18.5834 3.13327 18.5834 3.36662 18.5834 3.83333V4.39116C18.5834 4.61516 18.5834 4.72716 18.556 4.8313C18.5318 4.92359 18.4919 5.01103 18.438 5.0898C18.3772 5.17869 18.2926 5.25204 18.1233 5.39875L12.7935 10.0179C12.6242 10.1646 12.5396 10.238 12.4788 10.3269C12.425 10.4056 12.385 10.4931 12.3608 10.5854C12.3334 10.6895 12.3334 10.8015 12.3334 11.0255V15.382C12.3334 15.5449 12.3334 15.6264 12.3071 15.6969C12.2839 15.7591 12.2461 15.8149 12.197 15.8596C12.1413 15.9102 12.0657 15.9404 11.9143 16.001L9.08101 17.1343C8.77472 17.2568 8.62158 17.3181 8.49864 17.2925C8.39114 17.2702 8.29679 17.2063 8.23612 17.1148C8.16675 17.0101 8.16675 16.8452 8.16675 16.5153V11.0255C8.16675 10.8015 8.16675 10.6895 8.13938 10.5854C8.11512 10.4931 8.07519 10.4056 8.02134 10.3269C7.96056 10.238 7.87593 10.1646 7.70666 10.0179L2.37684 5.39875C2.20757 5.25204 2.12293 5.17869 2.06216 5.0898C2.0083 5.01103 1.96838 4.92359 1.94412 4.8313C1.91675 4.72716 1.91675 4.61516 1.91675 4.39116V3.83333Z" stroke="#1D2939" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <div class="label md">Bộ lọc</div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke=var(--gray-800);></path>
                        </svg>
                    </button>
                </div>
                <div class="SearchPageDetail-sort-btn select-input">
                    <label class="btn btn-btn btn-normal btn-outline input-group">
                        <input class="label md" value="Không sắp xếp" style="width: 100%">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" width="20px" ;height="20px" ;>
                            <path d="M6 9L12 15L18 9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke=var(--gray-800);></path>
                        </svg>
                    </label>
                    <div class="SearchPageDetail-dropdown dropdown">
                        <div class="SearchPageDetail-dropdown-item dropdown-item" value="Không sắp xếp">Không sắp xếp</div>
                        <div class="SearchPageDetail-dropdown-item dropdown-item" value="Giá thấp đến cao">Giá thấp đến cao</div>
                        <div class="SearchPageDetail-dropdown-item dropdown-item" value="Giá cao đến thấp">Giá cao đến thấp</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fresnel-container fresnel-greaterThan-mdless">
            <div class="flex gap-32 ">
                <div class="SearchPageDetail-side-bar-2">
                    <div class="SearchPageDetail-side-bar-header">
                        <div class="subheading md flex-grow">Lọc kết quả</div>
                        <div class="flex grap align-center">
                            <button type="button" class="btn btn-sm btn-link-color">
                                <div class="label sm">Đặt lại</div>
                            </button>
                            <button type="button" class="btn SearchPageDetail-apply-mb-btn btn-sm btn-link-color">
                                <div class="label sm">Áp dụng</div>
                            </button>
                        </div>
                    </div>
                    <div>
                        <div class="SearchPageDetail-filter-item SearchPageDetail-filter-feature">
                            <lable class="md">Tiện ích</lable>
                            <?php foreach ($features as $feature): ?>
                                <label for="<?= $feature['id'] ?>" class=" Checkbox-container">
                                    <input id="<?= $feature['id'] ?>" type="checkbox">
                                    <span class="Checkbox-checkmark Checkbox-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                    <div class="Checkbox-textGroup">
                                        <div class="sm Checkbox-title label"><?= $feature['text'] ?></div>
                                        <p class="sm"></p>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="SearchPageDetail-ship-list flex flex-col gap-32">
                        <?php
                        $count = 0;
                        $startNumber = ($currentPage - 1) * $data['recordsPerPage'] + 1;
                        ?>
                        <?php foreach ($ships as $ship):
                            $count++ ?>
                            <a href="<?= _WEB_ROOT ?>/du-thuyen/<?= $ship['slug'] ?>">
                                <div class="card ProductCard-list">
                                    <div class="ProductCard-imageWrapper">
                                        <div class="ProductCard-imageWrapper-image" style="width: 352px; height: 264px; position: relative; overflow: hidden;">
                                            <img src="<?= $ship['thumbnail'] ?>" alt="mixivivu" width="100%" height="100%" loading="lazy" style="object-fit: cover;">
                                        </div>
                                        <div class="Badge-warning Badge-sm Badge-container ProductCard-imageWrapper-badge">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.2443 4.17391C11.4758 3.50799 11.5916 3.17503 11.7627 3.08276C11.9108 3.00289 12.0892 3.00289 12.2373 3.08276C12.4084 3.17503 12.5242 3.50799 12.7556 4.17391L14.2859 8.5763C14.3518 8.76583 14.3847 8.86059 14.4441 8.93116C14.4965 8.9935 14.5634 9.04209 14.6389 9.07269C14.7244 9.10734 14.8247 9.10938 15.0253 9.11347L19.6851 9.20843C20.3899 9.22279 20.7423 9.22998 20.883 9.36423C21.0047 9.48042 21.0598 9.65005 21.0297 9.81559C20.9948 10.0069 20.7139 10.2198 20.1521 10.6458L16.438 13.4615C16.2782 13.5828 16.1982 13.6434 16.1494 13.7216C16.1063 13.7908 16.0808 13.8694 16.075 13.9506C16.0685 14.0426 16.0975 14.1387 16.1556 14.3307L17.5053 18.7918C17.7094 19.4666 17.8115 19.804 17.7273 19.9792C17.6544 20.1309 17.5101 20.2357 17.3433 20.2582C17.1506 20.2841 16.8613 20.0828 16.2826 19.6801L12.4569 17.018C12.2922 16.9034 12.2099 16.8461 12.1204 16.8239C12.0413 16.8042 11.9587 16.8042 11.8796 16.8239C11.7901 16.8461 11.7078 16.9034 11.5431 17.018L7.71738 19.6801C7.1387 20.0828 6.84936 20.2841 6.65666 20.2582C6.48988 20.2357 6.34559 20.1309 6.2727 19.9792C6.18848 19.804 6.29056 19.4666 6.49471 18.7918L7.84436 14.3307C7.90246 14.1387 7.93151 14.0426 7.92497 13.9506C7.91919 13.8694 7.89365 13.7908 7.85056 13.7216C7.80179 13.6434 7.72184 13.5828 7.56195 13.4615L3.84791 10.6458C3.28611 10.2198 3.00521 10.0069 2.97034 9.81559C2.94015 9.65005 2.99527 9.48042 3.11699 9.36423C3.25764 9.22998 3.61007 9.22279 4.31492 9.20843L8.97472 9.11347C9.17533 9.10938 9.27564 9.10734 9.3611 9.07269C9.43659 9.04209 9.50346 8.9935 9.5559 8.93116C9.61526 8.86059 9.6482 8.76583 9.71408 8.5763L11.2443 4.17391Z" stroke="var(--warning-base)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <label class="xs"><?= $ship['score_review'] ?> (<?= $ship['num_reviews'] ?>) đánh giá</label>
                                        </div>
                                    </div>
                                    <div class="ProductCard-cardContent">
                                        <div class="ProductCard-body">
                                            <div class="Badge-default Badge-sm Badge-container ProductCard-location">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5.7 15C4.03377 15.6353 3 16.5205 3 17.4997C3 19.4329 7.02944 21 12 21C16.9706 21 21 19.4329 21 17.4997C21 16.5205 19.9662 15.6353 18.3 15M12 9H12.01M18 9C18 13.0637 13.5 15 12 18C10.5 15 6 13.0637 6 9C6 5.68629 8.68629 3 12 3C15.3137 3 18 5.68629 18 9ZM13 9C13 9.55228 12.5523 10 12 10C11.4477 10 11 9.55228 11 9C11 8.44772 11.4477 8 12 8C12.5523 8 13 8.44772 13 9Z" stroke="var(--gray-500)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <label class="xs"><?= $ship['category_name'] ?></label>
                                            </div>
                                            <p class="ProductCard-title subheading md"><?= $ship['title'] ?></p>
                                            <div class="ProductCard-description">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                    <path d="M3.62 17.28C3.71813 17.5267 3.91022 17.7242 4.15402 17.8292C4.39782 17.9343 4.67335 17.9381 4.92 17.84C5.16665 17.7419 5.36422 17.5498 5.46924 17.306C5.57426 17.0622 5.57813 16.7867 5.48 16.54L4.36 13.72L11 12.25V17C11 17.2652 11.1054 17.5196 11.2929 17.7071C11.4804 17.8946 11.7348 18 12 18C12.2652 18 12.5196 17.8946 12.7071 17.7071C12.8946 17.5196 13 17.2652 13 17V12.25L19.64 13.72L18.52 16.54C18.4713 16.6621 18.4471 16.7926 18.4489 16.9241C18.4507 17.0556 18.4784 17.1854 18.5304 17.3061C18.5824 17.4269 18.6577 17.5362 18.7521 17.6278C18.8464 17.7194 18.9578 17.7915 19.08 17.84C19.1978 17.8866 19.3233 17.9103 19.45 17.91C19.6503 17.9102 19.846 17.8502 20.0118 17.7379C20.1776 17.6256 20.3059 17.4661 20.38 17.28L21.93 13.37C21.9832 13.2348 22.0063 13.0896 21.9977 12.9445C21.989 12.7994 21.9489 12.658 21.88 12.53C21.8132 12.4025 21.7196 12.2909 21.6057 12.2029C21.4918 12.1149 21.3602 12.0525 21.22 12.02L18 11.31V7C18 6.73478 17.8946 6.48043 17.7071 6.29289C17.5196 6.10536 17.2652 6 17 6H15V3C15 2.73478 14.8946 2.48043 14.7071 2.29289C14.5196 2.10536 14.2652 2 14 2H10C9.73478 2 9.48043 2.10536 9.29289 2.29289C9.10536 2.48043 9 2.73478 9 3V6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7V11.31L2.78 12C2.63976 12.0325 2.5082 12.0949 2.39429 12.1829C2.28038 12.2709 2.18682 12.3825 2.12 12.51C2.05113 12.638 2.01098 12.7794 2.00234 12.9245C1.99371 13.0696 2.0168 13.2148 2.07 13.35L3.62 17.28ZM11 4H13V6H11V4ZM8 8H16V10.86L12.22 10H12.12H12H11.88H11.78L8 10.86V8ZM20.71 19.28C20.3591 19.3875 20.0232 19.5387 19.71 19.73C19.3914 19.9163 19.029 20.0145 18.66 20.0145C18.291 20.0145 17.9286 19.9163 17.61 19.73C16.9173 19.3392 16.1354 19.1339 15.34 19.1339C14.5446 19.1339 13.7627 19.3392 13.07 19.73C12.7471 19.9141 12.3817 20.011 12.01 20.011C11.6383 20.011 11.2729 19.9141 10.95 19.73C10.2566 19.3411 9.47499 19.1368 8.68 19.1368C7.88501 19.1368 7.10336 19.3411 6.41 19.73C6.09143 19.9163 5.72904 20.0145 5.36 20.0145C4.99096 20.0145 4.62857 19.9163 4.31 19.73C3.99683 19.5387 3.66087 19.3875 3.31 19.28C3.17694 19.2327 3.03537 19.2141 2.89461 19.2255C2.75385 19.2368 2.61709 19.2778 2.49334 19.3459C2.36958 19.4139 2.26163 19.5073 2.1766 19.6201C2.09157 19.7328 2.03138 19.8623 2 20C1.92535 20.2533 1.95389 20.5258 2.07941 20.7581C2.20493 20.9904 2.41724 21.1636 2.67 21.24C2.87136 21.2946 3.06347 21.3788 3.24 21.49C3.84671 21.846 4.53657 22.0357 5.24 22.04C5.9706 22.0401 6.68823 21.8469 7.32 21.48C7.71198 21.2638 8.15234 21.1504 8.6 21.1504C9.04766 21.1504 9.48803 21.2638 9.88 21.48C10.5073 21.8387 11.2174 22.0274 11.94 22.0274C12.6626 22.0274 13.3727 21.8387 14 21.48C14.392 21.2638 14.8323 21.1504 15.28 21.1504C15.7277 21.1504 16.168 21.2638 16.56 21.48C17.1798 21.8499 17.8882 22.0453 18.61 22.0453C19.3318 22.0453 20.0402 21.8499 20.66 21.48C20.8365 21.3688 21.0286 21.2846 21.23 21.23C21.3631 21.2031 21.4893 21.1493 21.6009 21.0721C21.7126 20.9948 21.8073 20.8956 21.8793 20.7805C21.9514 20.6654 21.9992 20.5368 22.02 20.4027C22.0407 20.2685 22.0339 20.1315 22 20C21.9682 19.8647 21.9086 19.7374 21.8249 19.6265C21.7412 19.5155 21.6352 19.4232 21.5138 19.3554C21.3925 19.2877 21.2583 19.246 21.1199 19.233C20.9815 19.22 20.8419 19.236 20.71 19.28Z" fill="var(--gray-600)"></path>
                                                </svg>
                                                <p class="sm">Hạ thuỷ <?= $ship['year'] ?> - Tàu vỏ <?= $ship['shell'] ?> - <?= $ship['cabin'] ?> phòng</p>
                                            </div>
                                        </div>
                                        <div class="ProductCard-tags">
                                            <?php foreach ($ship['feature_texts'] as $feature): ?>
                                                <div class="Badge-default Badge-sm Badge-container ">
                                                    <label class="xs"><?= $feature ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="ProductCard-footer">
                                            <div>
                                                <div>
                                                    <p class="ProductCard-price subheading md" style="color: var(--primary-dark, #0E4F4F);"><?= number_format($ship['default_price']) ?>đ / khách</p>
                                                </div>
                                            </div>
                                            <button type="button" class="btn  btn-sm btn-color btn-primary">
                                                <div class="label sm">
                                                    Đặt ngay
                                                </div>
                                            </button>
                                        </div>
                                    </div>
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
                            <a href="<?= _WEB_ROOT ?>/tim-du-thuyen<?= isset($_GET['keyword']) ? '/search?keyword=' . $_GET['keyword'] . '&page=' . $data['currentPage'] - 1 : '/page/' . $data['currentPage'] - 1;
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
                                <a href="<?= _WEB_ROOT ?>/tim-du-thuyen<?= isset($_GET['keyword']) ? '/search?keyword=' . $_GET['keyword'] . '&page=' . $i : '/page/' . $i ?>"
                                    class="Pagination-pagination-item <?= $data['currentPage'] == $i ? 'Pagination-selected' : '' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>

                            <a href="<?= _WEB_ROOT ?>/tim-du-thuyen<?= isset($_GET['keyword']) ? '/search?keyword=' . $_GET['keyword'] . '&page=' . $data['currentPage'] + 1 : '/page/' . $data['currentPage'] + 1 ?>"
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
            </div>
        </div>
    </div>
</div>