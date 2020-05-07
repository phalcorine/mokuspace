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
    

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4"><?= 'Movie Details' ?></h1>
    </div>

    <div class="container" align="center">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4 shadow-sm">
                    <img src="<?= $movie->backdropPath ?>" width="70%" height="70%" alt="<?= $movie->title ?>">
                    <div class="card-body">
                        <p class="card-text"><?= $movie->title ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if ($isFavorite == true) { ?>
                                <a href="<?= $this->url->get('user/movies/unfav/') . $movie->id ?>" class="btn btn-sm btn-primary">Remove from Favorites</a>
                            <?php } else { ?>
                                <a href="<?= $this->url->get('user/movies/fav/') . $movie->id ?>" class="btn btn-sm btn-primary">Add to Favorites</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <dl class="row">
                    <dt class="col-sm-4">Movie Title: </dt>
                    <dd class="col-sm-8"><?= $movie->title ?></dd>
                    <dt class="col-sm-4">Overview:</dt>
                    <dd class="col-sm-8"><?= $movie->overview ?></dd>
                    <dt class="col-sm-4">Genre:</dt>
                    <dd class="col-sm-8">
                        <?php $v17288204681iterated = false; ?><?php $v17288204681iterator = $genres; $v17288204681incr = 0; $v17288204681loop = new stdClass(); $v17288204681loop->self = &$v17288204681loop; $v17288204681loop->length = count($v17288204681iterator); $v17288204681loop->index = 1; $v17288204681loop->index0 = 1; $v17288204681loop->revindex = $v17288204681loop->length; $v17288204681loop->revindex0 = $v17288204681loop->length - 1; ?><?php foreach ($v17288204681iterator as $genre) { ?><?php $v17288204681loop->first = ($v17288204681incr == 0); $v17288204681loop->index = $v17288204681incr + 1; $v17288204681loop->index0 = $v17288204681incr; $v17288204681loop->revindex = $v17288204681loop->length - $v17288204681incr; $v17288204681loop->revindex0 = $v17288204681loop->length - ($v17288204681incr + 1); $v17288204681loop->last = ($v17288204681incr == ($v17288204681loop->length - 1)); ?><?php $v17288204681iterated = true; ?>
                            <?= $genre->name ?>
                            <?php if ($v17288204681loop->last == false) { ?>
                                <?= ', ' ?>
                            <?php } ?>
                        <?php $v17288204681incr++; } if (!$v17288204681iterated) { ?>
                            <?= 'General' ?>
                        <?php } ?>
                    </dd>
                    <dt class="col-sm-4">Movie Runtime: </dt>
                    <dd class="col-sm-8"><?= $movie->runtime . ' (minutes)' ?></dd>
                    <dt class="col-sm-4">Rating (Average):</dt>
                    <dd class="col-sm-8"><?= $movie->voteAverage ?></dd>
                    <dt class="col-sm-4">Released Status: </dt>
                    <dd class="col-sm-8"><?= $movie->status ?></dd>
                    <dt class="col-sm-4">Released Date:</dt>
                    <dd class="col-sm-8"><?= $movie->releaseDate ?></dd>
                </dl>
                <div class="card-body">
                    <h4>@TODO: Videos... </h4>
                </div>
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
