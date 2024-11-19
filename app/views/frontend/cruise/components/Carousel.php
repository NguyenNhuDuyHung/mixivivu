<div class="ShipDetail-carousel">
    <div class="flex gap-32 justify-center Carousel-carousel" id="carousel-container">
        <button type="button"
            class="btn btn-btn Carousel-carousel-btn Carousel-left-btn btn-normal btn-primary btn-iconOnly">
            <div class="label md"></div>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M4.16602 10H15.8327M4.16602 10L9.16602 5M4.16602 10L9.16602 15"
                    stroke="var(--gray-800, #1d2939)"
                    stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <button type="button"
            class="btn btn-btn Carousel-carousel-btn Carousel-right-btn btn-normal btn-primary btn-iconOnly">
            <div class="label md"></div>
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>

        <div class="Carousel-carouselItem">
            <div style="width: 100%; height: 100%; position: relative; overflow: hidden;">
                <img alt="du-thuyen-banner"
                    src="https://res.cloudinary.com/dhnp8ymxv/image/upload/v1731382044/du-thuyen-heritage-binh-chuan-cat-ba/zrpr1iamwfdt2q7l.webp.webp"
                    width="100%" height="100%" loading="lazy" style="object-fit: cover;">
            </div>
        </div>
    </div>
</div>


<?php
$imagesJson = json_encode($cruiseImages);
?>

<script>
    const cruiseImages = <?php echo $imagesJson; ?>;
    const itemsPerPage = 2; // Số ảnh mỗi lần hiển thị
    let currentIndex = 0; // Vị trí bắt đầu

    // Hàm hiển thị ảnh
    function loadImages() {
        const container = document.getElementById('carousel-container');
        const endIndex = Math.min(currentIndex + itemsPerPage, cruiseImages.length);

        // Duyệt qua mảng từ vị trí hiện tại và thêm ảnh vào container
        for (let i = currentIndex; i < endIndex; i++) {
            const item = document.createElement('div');
            item.classList.add('Carousel-carouselItem');
            item.innerHTML = `<div style="width: 100%; height: 100%; position: relative; overflow: hidden;">
                                <img alt="du-thuyen-banner" src="${cruiseImages[i]}" width="100%" height="100%" loading="lazy" style="object-fit: cover;">
                            </div>`;
            container.appendChild(item);
        }

        // Cập nhật vị trí hiện tại
        currentIndex = endIndex;
    }

    // Gắn sự kiện click vào nút
    document.querySelector('.Carousel-right-btn').addEventListener('click', loadImages);
    document.querySelector('.Carousel-left-btn').addEventListener('click', () => {
        currentIndex = Math.max(currentIndex - itemsPerPage * 2, 0);
        loadImages();
    })
    // Hiển thị 3 ảnh đầu tiên khi tải trang
    loadImages();
</script>