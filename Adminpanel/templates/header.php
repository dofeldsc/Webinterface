<!-- Logo -->
<a href="<?php echo DE100_DOMAIN; ?>index.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>DE</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>DE100</b>-Adminpanel</span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
        <a href="<?php echo DIR_TO_SITES; ?>profile.php">
          <img src="<?php echo DIR_TO_IMG?>avatar.png" class="user-image" alt="User Image">
          <span class="hidden-xs text-<?php echo $user->rankcolor();?>"><strong><?php echo $user->username();?></strong></span>
        </a>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="<?php echo DE100_DOMAIN; ?>logout.php" title='Logout'><i class="fa fa-sign-out fa-lg"></i></a>
      </li>
    </ul>
  </div>

</nav>