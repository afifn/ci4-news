<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/main/app.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/pages/auth.css" />
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/logo/favicon.png" type="image/png" />
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?= base_url() ?>"><img src="<?= base_url() ?>/assets/images/logo/logo.svg" alt="Logo" /></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>

                    <?php if (session()->getFlashdata('message')) : ?>
                        <div class="alert alert-danger alert-dismiss fade show" role="alert">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif ?>
                    <form action="<?= base_url('login/auth') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="Email" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Log in
                        </button>
                    </form>

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>