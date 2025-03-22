<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>NORSU Mabinay Campus Supply and Equipment Inventory System</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="<?= base_url() ?>assets/img/logo.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>

                            <?php if (session()->get('error') != '') : ?>
                                <div class="alert alert-danger align-items-center text-center" role="alert">
                                    <b class="fa fa-exclamation-triangle"></b> <?= session()->get('error') ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url() ?>auth/login" method="post" autocomplete="off">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block w-100" type="submit">Login</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/feather.min.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>
    <script>
        $(".alert").fadeTo(3000, 500).slideUp(500, function() {
            $(".alert").slideUp(500);
            $(".alert").remove();
        });
    </script>

</body>

</html>