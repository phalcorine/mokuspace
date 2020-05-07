<?= $this->tag->getDoctype() ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->tag->getTitle() ?>
    <?= $this->assets->outputCss('head') ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $this->url->get('img/favicon.ico') ?>"/>
</head>
<body class="fond-img">
    <div class="container">
        
    <div class="alert alert-info">
        <h1>Error 404 - The page cannot be found</h1>
    </div>

    </div>
    <?= $this->assets->outputJs('footer') ?>
</body>
</html>
