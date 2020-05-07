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
        
    <div class="alert alert-danger">
        <h1>Error 401 - Access prohibited to the requested page</h1>
    </div>
    <div class="form-center text-center">
        <img class="mb-4" src="<?= $this->url->get('img/favicon-32x32.png') ?>" alt="logo">

        <small>To login,<a href="<?= $this->url->get('/') ?>"> click here </a></small><br>
        <small>If you don't have an account,<a href="<?= $this->url->get('register') ?>"> click here to register </a></small>
    </div>

    </div>
    <?= $this->assets->outputJs('footer') ?>
</body>
</html>
