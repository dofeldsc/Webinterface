<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo isset($DE100_GLOBALS['title']) ? $DE100_GLOBALS['title'] : DE100_SITE_NAME ?></title>
    <?php render_stylesheets(); ?>
    <?php render_javascripts(false); ?>
</head>
<body class="hold-transition login-page">
<?php render_messages(); ?>
<div class="login-box">
  <div class="login-logo">
      <b>DE100</b>-Adminpanel
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Bitte logge dich ein</p>
  
    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Benutzername">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Passwort">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login_submit">Log In</button>
        </div>
      </div>
    </form>
  <br>
  <p class="text-center"><strong><a href="http://www.de100-altis.life/">DE100 Webseite</a> | <a href="http://forum.de100-altis.life//">DE100 Forum</a> | <a href="http://www.de100-altis.life/impressum/">Impressum</a></strong></p>
  </div>
  <!-- /.login-box-body -->
</div>

    <?php render_javascripts(true); ?>
</body>
</html>