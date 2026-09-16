<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'InnerEcho' ?></title>
    <link rel="stylesheet" href="/css/style.css?v=<?= time() ?>">
    <?php if (!empty($stylesheets)): ?>
        <?php foreach ($stylesheets as $css): ?>
            <link rel="stylesheet" href="/css/<?= $css ?>?v=<?= time() ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6a2c66ea03.js" crossorigin="anonymous"></script>
</head>
<body class="manrope-font">
    <?= $content ?>
</body>
</html>
