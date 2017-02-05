<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $DE100_GLOBALS['title']; ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <p class="notification">5</p>
							<p>Benachrichtigungen</p>
							<b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Haaaaai</a></li>
                      </ul>
                </li>
                <?php if (!$user->isLoggedIn()): ?>
                <li>
                    <a href="/login">
						<i class="fa fa-sign-in"></i>
						<p>Login</p>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="/logout">
						<i class="fa fa-sign-out"></i>
						<p>Logout</p>
                    </a>
                </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>
<?php render_messages(); ?>