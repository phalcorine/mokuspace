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
        
    <?php if (isset($errors)) { ?>
        <div class="alert alert-danger">
            <?= $errors ?>
        </div>
    <?php } ?>

    <form method="post" class="form-center text-center">
        <img class="mb-4" src="<?= $this->url->get('img/favicon-32x32.png') ?>" alt="logo">
        <h1 class="h3 mb-5 font-weight-normal">Login to MovieSpace</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            <?= $loginForm->render('email') ?>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <?= $loginForm->render('password') ?>
        </div>

        <div class="mb-3">
            <?= $loginForm->render('submit_button') ?>
        </div>

        <small>If you don't have an account,<a href="<?= $this->url->get('register') ?>" alt="register"> click here to create one!</a></small>
    </form>

    </div>
    <?= $this->assets->outputJs('footer') ?>
</body>
</html>
