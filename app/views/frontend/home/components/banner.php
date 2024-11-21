<div class="home-banner">
    <video class="home-bg-video" src="https://res.cloudinary.com/dhnp8ymxv/video/upload/v1731849290/Mixivivuduthuyen_cnlkmw.mp4" autoplay muted playinside
        loop></video>

    <div class="card flex flex-col justify-center gap-40 search-box home-search-box">
        <div class="flex flex-col gap-16 gray-900">
            <h4 class="text-center search-box-title home-search-box-title">
                Bạn lựa chọn du thuyền Hạ Long nào?
            </h4>
            <p class="lg text-center search-box-description home-search-box-description">
                Hơn 100 tour du thuyền hạng sang giá tốt đang chờ bạn
            </p>
        </div>
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
                    <input class="p-md" type="text" placeholder="Nhập tên du thuyền" value="">
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
                        </svg>
                        <input id="allLocations" class="p-md" type="button" value="Tất cả địa điểm">
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
                        <?php foreach ($cruiseCategories as $cruiseCategory): ?>
                            <div class="search-box-dropdown-item" value="<?= $cruiseCategory['name'] ?>">
                                <?= $cruiseCategory['name'] ?>
                            </div>
                        <?php endforeach; ?>
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
                        <div class="search-box-dropdown-item" value="Tất cả mức giá">
                            Tất cả mức giá
                        </div>
                        <div class="search-box-dropdown-item" value="Từ 1 đến 3 triệu">
                            Từ 1 đến 3 triệu
                        </div>
                        <div class="search-box-dropdown-item" value="Từ 3 đến 6 triệu">
                            Từ 3 đến 6 triệu
                        </div>
                        <div class="search-box-dropdown-item" value="Trên 6 triệu">
                            Trên 6 triệu
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-btn search-box-submit-btn btn-normal btn-primary">
                <div class="label md">Tìm kiếm</div>
            </button>
        </div>
    </div>
</div>