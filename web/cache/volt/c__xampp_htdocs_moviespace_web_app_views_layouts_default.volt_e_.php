a:3:{i:0;s:1362:"<?= $this->tag->getDoctype() ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->tag->getTitle() ?>
    <?= $this->assets->outputCss('head') ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $this->url->get('img/favicon.ico') ?>"/>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <a class="btn btn-outline-primary pull-left" href="<?= $this->url->get('/movies') ?>">Movies</a> &nbsp; &nbsp;
        <h5 class="my-0 mr-md-auto font-weight-normal">
            <?php if (isset($user)) { ?>
                Hi <?= $user->firstName ?>
            <?php } else { ?>
                Hi, Guest,
            <?php } ?>
        </h5>
        <a class="btn btn-outline-primary" href="<?= $this->url->get('/user/movies') ?>">My Favorites</a> &nbsp; &nbsp;
        <a class="btn btn-outline-primary" href="<?= $this->url->get('/logout') ?>">Log out</a>
    </div>

    <div class="container">
        <div class="col-md-8">
            
            <?php if ($this->flashSession->has()) { ?>
                <?= $this->flashSession->output() ?>
            <?php } ?>
        </div>
    </div>
    ";s:7:"content";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:20:"

        

    ";s:4:"file";s:62:"C:\xampp\htdocs\moviespace\web/app/views/\layouts/default.volt";s:4:"line";i:37;}}i:1;s:778:"
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="<?= $this->url->get('img/favicon-32x32.png') ?>" alt="" width="24" height="24">
                <small class="d-block mb-3 text-muted">MovieSpace &copy; <?= date('Y') ?></small>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">The Team</a></li>
                    <li><a class="text-muted" href="#">Contact us</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <?= $this->assets->outputJs('footer') ?>
</body>
</html>
";}