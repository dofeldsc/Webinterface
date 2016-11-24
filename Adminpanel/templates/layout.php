<?php
if (!$user->isLoggedIn()) {
    redirect(DE100_DOMAIN."login.php");
}

if(time() - Session::get("timestamp") > (60*15)) {
    Session::delete("user");
    Session::delete("timestamp");
    redirect(DE100_DOMAIN."login.php","Aus Sicherheitsgründen, wurdest du automatisch, nach 15 Minuten, ausgeloggt.",MSG_TYPE_ERROR);
} else {
    Session::put("timestamp",time());
}
if ($DE100_GLOBALS['permission'] != "permission") {
    if (!$user->hasPermision($DE100_GLOBALS['permission'])) {
        redirect(DE100_DOMAIN,"Was hast du den da Versucht ?",MSG_TYPE_ERROR);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo isset($DE100_GLOBALS['title']) ? $DE100_GLOBALS['title'] : DE100_SITE_NAME ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <?php render_stylesheets(); ?>
    <?php render_javascripts(false); ?>
</head>
<body class="skin-black fixed sidebar-mini hold-transition">
    <div class="wrapper">
        <?php if (file_exists (DIR_TEMPLATES . "/modals/" . $DE100_GLOBALS['content'] . ".php")) : ?>
            <?php require(DIR_TEMPLATES . "/modals/" . $DE100_GLOBALS['content'] . ".php"); ?>
        <?php endif; ?>
        <header class="main-header">
            <?php require(DIR_TEMPLATES . "/header.php"); ?>
        </header>
        <aside class="main-sidebar">
           <?php require(DIR_TEMPLATES . "/sidebar.php"); ?>
        </aside>
        <div class="content-wrapper">
            <?php render_messages(); ?>
            <?php if (file_exists (DIR_TEMPLATES . "/content/" . $DE100_GLOBALS['content'] . ".php")) : ?>
                <?php require(DIR_TEMPLATES . "/content/" . $DE100_GLOBALS['content'] . ".php"); ?>
            <?php else: ?>
                <?php require(DIR_TEMPLATES . "/content/404.php"); ?>
            <?php endif; ?>
        </div>
        <div class="main-footer">
            <?php require(DIR_TEMPLATES . "/footer.php"); ?>
        </div>
    </div>
    <?php render_javascripts(true); ?>
    <?php if (file_exists (DIR_TEMPLATES . "/scripts/" . $DE100_GLOBALS['content'] . ".php")) : ?>
        <?php require(DIR_TEMPLATES . "/scripts/" . $DE100_GLOBALS['content'] . ".php"); ?>
    <?php endif; ?>
</body>
</html>