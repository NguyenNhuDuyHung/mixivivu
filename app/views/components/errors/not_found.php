<div class="admin-notFound">
    <div class="card NotFound_not-found">
        <div class="NotFound_img-wrapper">
            <div style="width: 100%; height: 100%; position: relative; overflow: hidden;">
                <img src="<?php echo _WEB_ROOT ?>/public/img/sad.png" alt="mixivivu" width="100%" height="100%"
                    loading="lazy" style="object-fit: cover;">
            </div>
        </div>

        <div class="flex flex-col gap-8">
            <h5>Rất tiếc, Mixivivu không tìm thấy kết quả cho bạn</h5>
            <p class="md" style="color: var(--gray-600, #475467);">Nhấn OK để bắt đầu tìm kiếm mới.</p>
        </div>
        <a href="<?= $data['href-back'] ?>">
            <button type="button" class="btn btn-normal btn-outline">
                <div class="label md">OK</div>
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>
        </a>
    </div>
</div>