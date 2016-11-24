<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo DIR_TO_IMG?>avatar.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $user->username();?></p>
      <small class="text-<?php echo $user->rankcolor();?>"><?php echo $user->rankname();?></small>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li <?php echo ($DE100_GLOBALS['content'] == "dashboard")? 'class="active"' : ''; ?>>
      <a href="<?php echo DE100_DOMAIN; ?>index.php">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <?php if ($user->hasPermision("PlayersView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "players")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>players.php">
        <i class="fa fa-users"></i> <span>Spieler</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("VehicleView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "vehicles")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>vehicles.php">
        <i class="fa fa-car"></i> <span>Fahrzeuge</span>
      </a>
    </li>
    <?php endif; ?>
    <li class="header">BAN MANAGER</li>
    <li <?php echo ($DE100_GLOBALS['content'] == "onlineplayers")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>onlineplayers.php">
        <i class="fa fa-server"></i> <span>Online Spieler</span>
      </a>
    </li>
    <li <?php echo ($DE100_GLOBALS['content'] == "banmanager")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>banmanager.php">
        <i class="fa fa-gavel"></i> <span>Bans Verwalten</span>
      </a>
    </li>
    <?php if ($user->hasPermision("UserView")): ?>
    <li class="header">MEMBER VERWALTUNG</li>
    <li <?php echo ($DE100_GLOBALS['content'] == "viewusers")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>viewusers.php">
        <i class="fa fa-users"></i> <span>Benutzer</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("UserAdd")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "adduser")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>adduser.php">
        <i class="fa fa-plus"></i> <span>Benutzer Hinzufügen</span>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</section>
<!-- /.sidebar -->