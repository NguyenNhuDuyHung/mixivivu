<div class="LoginAdmin-container">
    <form action="" method="post" id="formLogin">
        <div class="LoginAdmin-modalLogin">
            <a href="#">
                <span
                    style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%"><span
                        style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%"><img
                            style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0"
                            alt="" aria-hidden="true"
                            src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27232%27%20height=%2762%27/%3e"></span><img
                        src="https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75" decoding="async"
                        data-nimg="intrinsic"
                        style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                        srcset="https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75 1x, https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75 2x"><noscript><img
                            srcSet="https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75 1x, https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75 2x"
                            src="https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75" decoding="async"
                            data-nimg="intrinsic"
                            style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%"
                            loading="lazy" /></noscript></span>
            </a>

            <div
                class="LoginAdmin-inputCustom <?php echo !empty($data['error']['username']) ? 'input-destructive' : ''; ?>">
                <label for="username" class="input-group">
                    <input id="username" class="p-md" placeholder="type your username here ..." name="username" value="<?php
                    if (!empty($data['error'])) {
                        echo $this->oldInfo('username', $data);
                    }
                    ?>" autocomplete="off">
                    <label for="username" class="sm">Username</label>
                </label>
                <p class="sm error">
                    <?php
                    if (!empty($data['error']['username'])) {
                        echo $data['error']['username'];
                    }
                    ?>
                </p>
            </div>

            <div
                class="LoginAdmin-inputCustom <?php echo !empty($data['error']['password']) ? 'input-destructive' : ''; ?>">
                <label for="password" class="input-group">
                    <input id="password" type="password" class="p-md" placeholder="type your password here ..." name="password" value="<?php
                    if (!empty($data['error'])) {
                        echo $this->oldInfo('password', $data);
                    }
                    ?>" autocomplete="off">
                    <label for="password" class="sm">Password</label>
                </label>
                <p class="sm error">
                    <?php
                    if (!empty($data['error']['password'])) {
                        echo $data['error']['password'];
                    }
                    ?>
                </p>
            </div>

            <button type="submit" class="btn btn-normal btn-primary">
                <div class="label md">Login</div>
            </button>
        </div>
    </form>
</div>