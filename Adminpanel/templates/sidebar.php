<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <?php if ($user->isLoggedIn()): ?>
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $user->getAvatar();?>" class="img-circle" alt="User Image">
      </div>
      <a class="pull-left info" title="Profile" href="<?php echo DIR_TO_SITES; ?>profile">
        <p><?php echo $user->username(true);?></p>
        <small class="text-<?php echo $user->rankcolor();?>"><?php echo $user->rankname();?></small>
      </a>
    </div>
  <?php endif; ?>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li <?php echo ($DE100_GLOBALS['content'] == "dashboard")? 'class="active"' : ''; ?>>
      <a href="<?php echo DE100_DOMAIN;?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li <?php echo ($DE100_GLOBALS['content'] == "stock")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES;?>stock">
        <i class="fa fa-line-chart"></i> <span>Börse</span>
      </a>
    </li>
    <li <?php echo ($DE100_GLOBALS['content'] == "inventory" || $DE100_GLOBALS['content'] == "auctions")? 'class="treeview active"' : 'class="treeview"'; ?>>
      <a href="#">
        <i class="fa fa-university"></i> <span>Auktionshaus</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <?php if ($user->isLoggedIn()): ?>
        <li <?php echo ($DE100_GLOBALS['content'] == "inventory")? 'class="active"' : ''; ?>><a href="<?php echo DIR_TO_SITES;?>inventory"><i class="fa fa-stack-overflow"></i> Online-Inventar</a></li>
        <?php endif; ?>
        <li <?php echo ($DE100_GLOBALS['content'] == "auctions")? 'class="active"' : ''; ?>><a href="<?php echo DIR_TO_SITES;?>auctions"><i class="fa fa-shopping-basket"></i> Auktionen</a></li>
      </ul>
    </li>
    <?php if ($user->hasPermision("PlayersView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "players")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>players">
        <i class="fa fa-users"></i> <span>Spieler</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("VehicleView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "vehicles")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>vehicles">
        <i class="fa fa-car"></i> <span>Fahrzeuge</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("GangsView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "gangs")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>gangs">
        <i class="fa fa-users"></i> <span>Gangs</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("PlayersView") || $user->hasPermision("BanPerm") || $user->hasPermision("BanTmp")): ?>
    <li class="header">BAN MANAGER</li>
    <?php endif; ?>
    <?php if ($user->hasPermision("PlayersView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "onlineplayers")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>onlineplayers">
        <i class="fa fa-server"></i> <span>Online Spieler</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("BanTmp") || $user->hasPermision("BanPerm")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "banmanager")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>banmanager">
        <i class="fa fa-gavel"></i> <span>Bans Verwalten</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("UserView") || $user->hasPermision("LogsView") ): ?>
    <li class="header">BENUTZER VERWALTUNG</li>
    <?php endif; ?>
    <?php if ($user->hasPermision("UserView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "viewusers")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>viewusers">
        <i class="fa fa-users"></i> <span>Benutzer</span>
      </a>
    </li>
    <?php endif; ?>
    <?php if ($user->hasPermision("LogsView")): ?>
    <li <?php echo ($DE100_GLOBALS['content'] == "logs")? 'class="active"' : ''; ?>>
      <a href="<?php echo DIR_TO_SITES; ?>logs">
        <i class="fa fa-history"></i> <span>Logs</span>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</section>
<!-- /.sidebar -->