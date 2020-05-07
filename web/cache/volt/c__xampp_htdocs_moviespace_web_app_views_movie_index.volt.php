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
    
    <?php $pageRoute = 'movies'; ?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">All Movies</h1>
    </div>

    <div class="container">
        <div class="row">
            <?php $v16228372731iterated = false; ?><?php foreach ($page->items as $movie) { ?><?php $v16228372731iterated = true; ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        
                        <img src="<?= $movie->backdropPath ?>" width="100%" height="225" alt="<?= $movie->title ?>">
                        <div class="card-body">
                            <p class="card-text"><h3><?= $movie->title ?></h3></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?= $this->url->get('movie/') . $movie->id ?>" class="btn btn-sm btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } if (!$v16228372731iterated) { ?>
                <p>No movies have been uploaded yet.</p>
            <?php } ?>
        </div>

        
        <div class="row">
            <div class="col-sm-1">
                <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
                    <?= $page->current . ' / ' . $page->total_pages ?>
                </p>
            </div>
            <div class="col-sm-11">
                <nav>
                    <ul class="pagination">
                        <li><?= $this->tag->linkto([$pageRoute, 'First', 'class' => 'page-link']) ?></li>
                        <li><?= $this->tag->linkto([$pageRoute . '?page=' . $page->before, 'Previous', 'class' => 'page-link']) ?></li>
                        <li><?= $this->tag->linkto([$pageRoute . '?page=' . $page->next, 'Next', 'class' => 'page-link']) ?></li>
                        <li><?= $this->tag->linkto([$pageRoute . '?page=' . $page->last, 'Last', 'class' => 'page-link']) ?></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

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
