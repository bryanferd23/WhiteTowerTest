<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title><?php $character['name'] ? $character['name']: 'Character' ?></title>
</head>
<body class="bg-light min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('characters') ?>">LIST OF CHARACTERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('user/characters') ?>">SAVED CHARACTERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="text-center p-5">
        <h1>View Page Character</h1>
    </div>
    <div class="container p-5 col-12 col-md-6 mx-auto">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php else: ?>
        <div class="float-left col-12">
            <?php
                $referrer = $_SERVER['HTTP_REFERER'] ?? '';
                $source   = $_GET['source'] ?? 'main';
                $page     = $_GET['page'] ?? '1';

                if ($source === 'saved') {
                    $backUrl  = base_url('user/characters?page=' . $page);
                    $backText = 'SAVED CHARACTERS';
                } else {
                    $backUrl  = base_url('characters?page=' . $page);
                    $backText = 'LIST OF CHARACTERS';
                }
            ?>
            <a href="<?php echo $backUrl?>" class="btn btn-outline-secondary mb-3">
                <i class="bi bi-arrow-left"></i> <?php echo $backText?>
            </a>
        </div>
        <div class="row">
            <div class="col-12 col-md-5 mt-4">
                <h4 class="card-text mb-4"><?= $character['name'] ?></h4>
                <p class="card-text mb-1"><strong>Height:</strong> <?= $character['height'] ?> cm</p>
                <p class="card-text mb-1"><strong>Hair Color:</strong> <?= $character['hair_color'] ?></p>
                <p class="card-text mb-1"><strong>Gender:</strong> <?= $character['gender'] ?></p>
            </div>
        </div>

        <div class="d-flex text-center justify-content-center mt-4">
            <div class="d-flex gap-4">
                <?php if(!$character['exists']): ?>
                    <form action="<?= url_to('user.character.create', $character['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="character_id" value="<?= $character['id'] ?>">
                        <input type="hidden" name="source" value="<?= $source ?>">
                        <input type="hidden" name="page" value="<?= $page ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Save Character
                        </button>
                    </form>
                <?php else: ?>
                    <form action="<?= url_to('user.character.delete', $character['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this character?');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="character_id" value="<?= $character['id'] ?>">
                        <input type="hidden" name="source" value="<?= $source ?>">
                        <input type="hidden" name="page" value="<?= $page ?>">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete Character
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
            
            
        
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>