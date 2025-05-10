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
        <h1>List of Characters</h1>
    </div>
    <div class="container p-5">
        <?php if (session()->has('errors')): ?>
            <div class="position-absolute top-10 end-0 p-3" style="z-index: 11;">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <span class="me-2">&#x26A0;</span>
                    <strong class="me-auto text-danger">Error</strong>
                </div>
                <div class="toast-body">
                    <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?php echo $error?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (session()->has('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
                
        <div class="float-left col-12">
            <h4>Characters</h4>
        </div>
        <div class="row">
            <?php foreach($characters as $index => $character): ?>
                <?php 
                    $urlParts = explode('/', rtrim($character['url'], '/')); 
                    $id = end($urlParts);
                ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="<?= url_to('character.show', $id) ?>?source=main&page=<?= $current_page ?>" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <p class="card-text mb-1"><strong>ID:</strong> <?= $id ?></p>
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
        </div>
        
        <?php if($total_pages > 1): ?>
            <div class="d-flex justify-content-center text-center">
                <div class="pagination-container">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php if($prev_page): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= base_url('characters?page=' . $prev_page) ?>">Previous</a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            <?php endif; ?>
                            
                            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= base_url('characters?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if($next_page): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= base_url('characters?page=' . $next_page) ?>">Next</a>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Flash alert message
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert, .toast');
            if (alerts.length > 0) {
                // Set timeout to hide after 3 seconds (3000 ms)
                setTimeout(function() {
                    alerts.forEach(function(alert) {
                        // For standard Bootstrap alerts
                        if (alert.classList.contains('alert')) {
                            setTimeout(function() {
                                alert.remove();
                            }, 150);
                        }
                        
                        // For Bootstrap toasts
                        if (alert.classList.contains('toast')) {
                            setTimeout(function() {
                                alert.remove();
                            }, 150);
                        }
                    });
                }, 3000);
            }
        });
    </script>
</body>
</html>