<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (!empty($page_title) ? $page_title : 'Home'); ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/css/frontend/layout.css">
</head>

<body>
    <div class="app">
        <?php 
        $this->render('components/client/header');

        $this->render($content, $data);

        $this->render('components/client/footer');
        ?>
    </div>

    <script type="module" src="<?php echo _WEB_ROOT; ?>/public/assets/client/js/script.js"></script>
</body>

</html>