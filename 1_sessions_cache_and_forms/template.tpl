<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>1. Сессии, кеши, сложные формы</title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="custom.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head>

<body>

    <div class="container">

        <form class="form-login" id="form-login" method="post" action="">
            <?php if (isset($_SESSION['fails']) && count($_SESSION['fails']) > 0) { ?>
                <?php foreach ($_SESSION['fails'] as $fail) { ?>
                <p class="text-danger"><?php echo $fail; ?></p>
                <?php } ?>
            <?php } ?>

            <h2 class="form-login-heading text-center">Enter your email and password</h2>

            <input type="hidden" name="action" value="login" />

            <div class="form-group">
                <label for="input-login">Enter your email</label>
                <input id="input-login" type="text" class="form-control" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
            </div>

            <div class="form-group">
                <label for="input-password">Enter your password</label>
                <input id="input-password" type="password" class="form-control" name="password" value="" />
            </div>

            <?php if ($_SESSION['validation'] == 'sms') { ?>
            <div class="form-group">
                <label for="input-sms">Enter code from SMS (in demo mode default is: <?php echo CHECK_SMS;?> )</label>
                <input id="input-sms" type="text" class="form-control" name="check_sms" value="" />
            </div>
            <?php } elseif ($_SESSION['validation'] == 'email') { ?>
            <div class="form-group">
                <label for="input-email">Enter code from EMAIL (in demo mode default is: <?php echo CHECK_EMAIL;?> )</label>
                <input id="input-email" type="text" class="form-control" name="check_email" value="" />
            </div>
            <?php } elseif ($_SESSION['validation'] == 'captcha') { ?>
            <div class="form-group">
                <label for="input-captcha">Enter code from CAPTCHA (in demo mode default is: <?php echo CHECK_CAPTCHA;?> )</label>
                <input id="input-captcha" type="text" class="form-control" name="check_captcha" value="" />
            </div>
            <?php } ?>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>

    </div> <!-- /container -->

    <script type="text/javascript">

       $('#form-login').submit(function(e) {
           $("#form-login button:submit").prop('disabled', true);
       });

    </script>

</body>
</html>