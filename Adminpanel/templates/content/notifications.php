<?php
    $notifications = Notify::get($user->id(),false,0);
    $crnt = "";
    $count = 0;
    $title = false;
?>

<div class="content-header">
    <h1>Benachrichtigungen <span title="" class="badge bg-light-blue"><?php echo Notify::count($user->id());?></span></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo DIR_TO_SITES ;?>profile">Profil</a></li>
        <li class="active">Alle Benachrichtigungen</li>
    </ol>
</div>
<div class="content">
    <div class="row">
        <div class="col-xs-12">      	
        <?php if(count($notifications) > 0):?>
            <ul class="timeline">
            <?php 
                foreach ($notifications as $notif) :
                    $date = date('Y-m-d',strtotime($notif['insertDate']));
                    if ($date != $crnt && $count <= 3) {
                            switch (date('D',strtotime($date))) {
                                case 'Mon':
                                    $day = "Montag";
                                    break;
                                
                                case 'Tue':
                                    $day = "Dienstag";
                                    break;

                                case 'Wed':
                                    $day = "Mittwoch";
                                    break;

                                case 'Thu':
                                    $day = "Donnerstag";
                                    break;

                                case 'Fri':
                                    $day = "Freitag";
                                    break;

                                case 'Sat':
                                    $day = "Samstag";
                                    break;

                                case 'Sun':
                                    $day = "Sonntag";
                                    break;
                            }
                            if ($count == 3) {
                                $day = "Älter";
                            }
                            if ($date == date('Y-m-d')) {
                                echo '<li class="time-label"><span class="bg-green">'.$day.'</span></li>';
                            } else {
                                echo '<li class="time-label"><span class="bg-yellow">'.$day.'</span></li>';
                            }
                            $crnt = $date;
                            $count += 1;
                    }
                    switch ($notif['type']) {
                        case 1:
                            $type = "fa fa-exclamation-triangle bg-red";
                            break;
                        
                        default:
                            $type = "fa fa-envelope bg-blue";
                            break;
                    }
                    ?>
                    <li>
                        <!-- timeline icon -->
                        <i class="<?php echo $type;?>"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('H:i',strtotime($notif['insertDate'])); ?></span>
                            <h3 class="timeline-header">Benachrichtigung</h3>
                            <div class="timeline-body">
                               <?php echo $notif['text'];?>
                            </div>
                        </div>
                    </li>
            <?php
                endforeach;
            ?>
                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        <?php else: ?>
            <h4>Du hast keine Benachrichtigungen</h4>
        <?php endif; ?>
        </div>
    </div>
</div>