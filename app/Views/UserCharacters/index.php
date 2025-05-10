<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Characters</title>
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
        <h1>Saved Characters</h1>
    </div>
    <div class="container p-5">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php else: ?>
            <div class="float-left col-12">
                <h4>Characters</h4>
            </div>
            <div class="row">
                <?php if(empty($characters)): ?>
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            No characters have been added to your collection yet. 
                            Start adding characters to see them here!
                            <br>
                            <a href="<?= base_url('characters') ?>" class="btn btn-outline-secondary mt-3">
                                LIST OF CHARACTERS
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($characters as $index => $character): ?>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <a href="<?= url_to('character.show', $character['character_id']) ?>?source=saved&page=<?= $current_page ?>" class="text-decoration-none">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <p class="card-text mb-1"><strong>ID:</strong> <?= $character['character_id'] ?></p>
                                        <p class="card-text mb-1"><strong>Name:</strong> <?= $character['name'] ?></p>
                                        <p class="card-text"><strong>Gender:</strong> <?= ucfirst($character['gender']) ?></p>
                                    </div>
                                    <div class="card-footer bg-transparent text-muted text-end">
                                        <small>&mdash; View More Details</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <?php if($total_pages > 1): ?>
            <div class="d-flex justify-content-center text-center">
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php if($prev_page): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= base_url('user/characters?page=' . $prev_page) ?>">Previous</a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            <?php endif; ?>
                            
                            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= base_url('user/characters?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if($next_page): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= base_url('user/characters?page=' . $next_page) ?>">Next</a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>