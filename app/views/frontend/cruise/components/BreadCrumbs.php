<div class="ShipDetail-breadCrumbsWrapper">
    <div class="container ShipDetail-breadCrumbs">
        <div class="BreadCrumbs-breadCrumbsContainer">
            <div class="Breadcrumbs-breadCrumb">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
                    <path
                        d="M8 17H16M11.0177 2.76401L4.23539 8.03914C3.78202 8.39176 3.55534 8.56807 3.39203 8.78887C3.24737 8.98446 3.1396 9.2048 3.07403 9.43907C3 9.70353 3 9.99071 3 10.5651V17.8C3 18.9201 3 19.4802 3.21799 19.908C3.40973 20.2843 3.71569 20.5903 4.09202 20.782C4.51984 21 5.0799 21 6.2 21H17.8C18.9201 21 19.4802 21 19.908 20.782C20.2843 20.5903 20.5903 20.2843 20.782 19.908C21 19.4802 21 18.9201 21 17.8V10.5651C21 9.99071 21 9.70353 20.926 9.43907C20.8604 9.2048 20.7526 8.98446 20.608 8.78887C20.4447 8.56807 20.218 8.39176 19.7646 8.03914L12.9823 2.76401C12.631 2.49076 12.4553 2.35413 12.2613 2.30162C12.0902 2.25528 11.9098 2.25528 11.7387 2.30162C11.5447 2.35413 11.369 2.49076 11.0177 2.76401Z"
                        stroke="var(--gray-600, #475467)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <a href="<?= _WEB_ROOT ?>/tim-du-thuyen">
                <div class="BreadCrumbs-breadCrumbs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M9 6L15 12L9 18" stroke="var(--gray-300, #d0d5dd)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                    <div class="Breadcrumbs-breadCrumb">
                        Tìm du thuyền
                    </div>
                </div>
            </a>
            <a href="<?= _WEB_ROOT ?>/du-thuyen/<?= $data['cruise']['slug'] ?>">
                <div class="BreadCrumbs-breadCrumbs BreadCrumbs-selected">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M9 6L15 12L9 18" stroke="var(--gray-300, #d0d5dd)" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                    <div class="Breadcrumbs-breadCrumb">
                        <?= $data['cruise']['title'] ?>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>