<a href="<?php echo DE100_DOMAIN;?>" class="logo">
  <span class="logo-mini"><b>DE</b></span>
  <span class="logo-lg"><b>DE100</b>-Online</span>
</a>

<nav class="navbar navbar-static-top">
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
    <?php if ($user->isLoggedIn()): ?>
      <li class="dropdown">
        <a title="Online-Bank" class="text-default" id="OnlineBank">
          $
          <?php
            echo number_format($user->onlineMoney(),0, ".", ",");
          ?>
        </a>
      </li>
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" id="notifTrigger">
          <i class="fa fa-bell-o"></i>
          <?php 
            $newC = Notify::count($user->id(),true);
          ?>
          <span class="label label-warning <?php echo ($newC > 0)? "" : "hidden"; ?>" id="notifNCount"><?php echo $newC; ?></span>
        </a>
        <ul class="dropdown-menu notif">
          <li class="header" id="notifNCountText" count="<?php echo Notify::getLastID($user->id());?>">Du hast <?php echo $newC; ?> neue Benachrichtigungen</li>
          <li>
            <ul class="menu" id="notifList">
            <?php
              $notifys = Notify::get($user->id(),false,10);
              if (!$notifys) {
                echo "<li><div><p class='notifText text-center'><i class='fa fa-info text-aqua'></i> Du hast keine Benachrichtigungen</p></div></li>";
              } else {
                foreach (Notify::get($user->id(),false,10) as $notif) {
                  echo "<li><div ".(($notif['seen'] == 0)? "id='notifRead' notifId='".$notif['id']."'":"")."><h4 class='notifHeader'><span class='notifNew ".(($notif['seen'] == 0)? "label label-warning'>Neu": "'>")."</span><small class='notifTime'><i class='fa fa-clock-o'></i> ".dateDifference($notif['insertDate'])."</small></h4><p class='notifText'>".preg_replace( "<br>", "", $notif['text'] )."</p></div></li>";
                }
              }
            ?>
            </ul>
          </li>
          <li class="footer"><a href="<?php echo DIR_TO_SITES;?>notifications" class="notif">Zeige alle</a></li>
        </ul>
      </li>
    <?php endif; ?>


      <li class="dropdown messages-menu">
        <a>
          <?php 
            if (Session::exists('server_status')) {
              if (Session::get('server_status')) {
                echo '<i class="fa fa-server fa-lg text-success" aria-hidden="true" title="Server ist Online"></i>';
              } else {
                echo '<i class="fa fa-server fa-lg text-danger" aria-hidden="true" title="Server ist Offline"></i><span>';
              }
            } else {
              echo '<i class="fa fa-server fa-lg text-success" aria-hidden="true" title="Server ist Online"></i>';
            }
            
          ?>
        </a>
      </li>
      <?php if ($user->isLoggedIn()): ?>
        <li class="dropdown user user-menu">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo $user->getAvatar();?>" class="user-image" alt="User Image">
            <span class="hidden-xs text-<?php echo $user->rankcolor();?>"><strong><?php echo $user->username(true);?></strong></span>
          </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo $user->getAvatar();?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user->username(true);?>
                  <small class="text-<?php echo $user->rankcolor();?>"> <?php echo $user->rankname();?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo DIR_TO_SITES; ?>profile" class="btn btn-primary btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo DE100_DOMAIN; ?>logout" class="btn btn-danger btn-flat">Ausloggen</a>
                </div>
              </li>
            </ul>
        </li>
      <?php else: ?>
        <li class="dropdown user user-menu">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Login
          </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <p class="text-center">Bitte logge dich ein, um alle Features nutzen zu können</p>
                <a href='?login&<?php echo get_form_token(); ?>=1' class="text-center">
                  <img src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_01.png'>
                </a>
              </li>
            </ul>
        </li>
      <?php endif; ?>
    </ul>
  </div>

</nav>