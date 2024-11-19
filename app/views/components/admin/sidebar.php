<aside class="Dashboard-sidebar">
    <div class="flex justify-center Dashboard-sidebar-logo">
        <div class="header-logo">
            <a href="/">
                <span
                    style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                    <span
                        style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                        <img style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0"
                            alt="" aria-hidden="true"
                            src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27156%27%20height=%2742%27/%3e">
                    </span>
                    <img src="<?php echo _WEB_ROOT ?> /views/assest/img/black-logo.webp" decoding="async"
                        data-nimg="intrinsic"
                        style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                        srcset="<?php echo _WEB_ROOT ?> /views/assest/img/black-logo.webp 1x, <?php echo _WEB_ROOT ?> /views/assest/img/black-logo.webp 2x">
                </span>
            </a>
        </div>
    </div>

    <div class="Dashboard-sidebar-menu">
        <a href="#" class="Dashboard-sidebar-menu-item">
            <label class="md">Dashboard</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/user/catalogue" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý nhóm người dùng</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/user" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý người dùng</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/ship/catalogue" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý nhóm du thuyền</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/ship" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý du thuyền</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/feature/catalogue" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý nhóm đặc trưng</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/feature" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý đặc trưng</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/long-desc/catalogue" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý nhóm long-desc</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/long-desc" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý long-desc</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/short-desc" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý short-desc</label>
        </a>

        <a href="<?php echo _WEB_ROOT ?>/backend/room" class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý phòng</label>
        </a>

        <a class="Dashboard-sidebar-menu-item">
            <label class="md">Quản lý orders</label>
        </a>

        <div class="divider">
            <svg xmlns="http://www.w3.org/2000/svg" width="240" height="1" viewBox="0 0 240 1" fill="none">
                <path d="M0.5 0.5H239.5" stroke="#E0E0E0" stroke-width="0.6" stroke-linecap="square" />
            </svg>
        </div>

        <div class="Dashboard-sidebar-menu-item">
            <form method="POST" action="<?php echo _WEB_ROOT ?>/backend/auth/logout">
                <button type="submit" class="btn btn-primary btn-sm btn-contact">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                    </svg>
                    <div class="label sm">Đăng xuất</div>
                </button>
            </form>
        </div>
    </div>
</aside>