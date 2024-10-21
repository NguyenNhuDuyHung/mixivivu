<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($page_title) ? $page_title : 'Home'); ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/css/<?php echo $layout; ?>">
    <?php
    echo (!empty($style) ? '<link rel="stylesheet" href="' . _WEB_ROOT . '/public/css/' . $style . '">' : '');
    ?>
</head>

<body>
    <?php
    !empty($header) ? $this->render($header) : '';
    ?>
    <div class="LayoutAdmin">
        <?php
        $this->render($content, $data);
        ?>
    </div>

    <?php
    !empty($footer) ? $this->render($footer) : '';
    ?>

    <?php echo (!empty($script) ? '<script type="module" src="' . _WEB_ROOT . '/public/js/' . $script . '"></script>' : '') ?>
</body>

</html>