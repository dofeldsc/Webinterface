<?php
// if (!$user->isLoggedIn()) {
//     redirect(DE100_DOMAIN."login");
// }

// if(time() - Session::get("timestamp") > (60*45)) {
//     Session::delete("user_id");
//     Session::delete("timestamp");
//     redirect(DE100_DOMAIN."login","Aus Sicherheitsgründen, wurdest du automatisch, nach 45 Minuten, ausgeloggt.",MSG_TYPE_ERROR);
// } else {
//     Session::put("timestamp",time());
// }

if (Input::exists('login')) {
    if (Tracker::getLoginAttempts() >= MAX_LOGIN_ATTEMPT) {
       // redirect(DE100_DOMAIN, MSG_EXCEED_MAX_LOGIN_ATTEMPTS, MSG_TYPE_ERROR);
    }
    
    Tracker::addTrack();

    if (!check_form_token('get')) {
        redirect(DE100_DOMAIN, MSG_INVALID_REQUEST, MSG_TYPE_ERROR);
    }

    $openid = new LightOpenID(DE100_DOMAIN);
    if(!$openid->mode) {
        $openid->identity = 'http://steamcommunity.com/openid';
        header('Location: ' . $openid->authUrl());
    } elseif ($openid->mode == 'cancel') {
        add_message("Login failed.", MSG_TYPE_ERROR);
    } else {
        if($openid->validate()) { 
            $id = $openid->identity;
            $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
            preg_match($ptn, $id, $matches);
            
            if (!headers_sent()) {
                $login = $user->login($matches[1]);
                if ($login) {
                    add_notify("Login erfolgreich.");
                    Tracker::clearLoginAttempts();
                } else {
                    $url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".STEAMAPIKEY."&steamids=".$matches[1]); 
                    $content = json_decode($url, true);
                    $user->create([
                        'username' => $content['response']['players'][0]['personaname'],
                        'player_id' => $matches[1],
                        'user_rank_id' => 5,
                        'permissions' => ([])
                    ]);                
                }
                redirect(DE100_DOMAIN);
            } else {
                ?>
                <script type="text/javascript">
                    window.location.href="<?=DE100_DOMAIN?>";
                </script>
                <noscript>
                    <meta http-equiv="refresh" content="0;url=<?=DE100_DOMAIN?>" />
                </noscript>
                <?php
                exit;
            }
        } else {
            add_message("Momentan kannst du dich nicht registrieren", MSG_TYPE_ERROR);
        }
    }
}

if ($DE100_GLOBALS['permission'] != "permission") {
    if (!$user->hasPermision($DE100_GLOBALS['permission'])) {
        redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
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

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo DIR_TO_IMG ?>favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo DIR_TO_IMG ?>favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/<?php echo DIR_TO_IMG ?>faviconsfavicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo DIR_TO_IMG ?>favicons/manifest.json">
    <link rel="mask-icon" href="<?php echo DIR_TO_IMG ?>favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <?php render_stylesheets(); ?>
    <?php render_javascripts(false); ?>
    <script>
        var logged = <?php echo ($user->isLoggedIn())? 1 : 0; ?>;
        var oBankLast = <?php echo ($user->isLoggedIn())? $user->onlineMoney() : 0; ?>;
        function update_oBank(data) {
            if (oBankLast != data) {
                oBankLast = data;
                $('#OnlineBank').text(numeral(data).format('$0,0'));
            }
        }

        function update_notifications(data,lastID) {
            if (data.length > 0) {
                $('#notifNCountText').attr('count',lastID);
                for (var i = 0; i < data.length; i++) {
                    var notif = data[i];
                    text = notif.text.replace(/<br\s*\/?>/gi,'&nbsp;');
                    $('#notifList').prepend("<li><div "+(notif.seen == 0? "id='notifRead' notifId='"+notif.id+"'":"")+"><h4 class='notifHeader'><span class='notifNew "+(notif.seen == 0? "label label-warning'>Neu" : "'>")+"</span><small class='notifTime'><i class='fa fa-clock-o'></i> vor einem Moment</small></h4><p class='notifText'>"+text+"</p></div></li>");
                    var val = parseInt($('#notifNCount').text());
                    $('#notifNCount').text(val+1);
                    $('#notifNCountText').text("Du hast "+(val+1)+" neue Benachrichtigungen");
                    if ($('#notifNCount').hasClass('hidden')) {
                        $('#notifNCount').removeClass('hidden');
                    }
                }
            }
        }

        function req_success(data) {
            if (typeof data == "number") {
                logged = false;
            } else {
                update_oBank(data.onlineBank);
                update_notifications(data.notif,data.lastNotif);
            }
        }

        function req_oBank() {
            if (logged) {
                $.ajax({
                    url: "<?php echo DIR_TO_HOOKS; ?>mainRequest.php",
                    data: { lastNotif:$('#notifNCountText').attr('count')},
                    type: "post",
                    dataType:"json",
                    success:req_success
                });
            }
        }

        function loop_oBank() {
            req_oBank()
            if (logged) {
                window.setTimeout(loop_oBank, 15000);
            }
        }
        $(document).ready(function () {
            $(".sidebar-toggle").on('click', function () {
                $.post( "<?php echo DIR_TO_HOOKS ?>sidebarChange.php", {} );
            });
            $('#notifTrigger').on('click', function (event) {
                $(this).parent().toggleClass('open');
            });

            $('div').on('click', 'div[id="notifRead"]', function (event) {
                var id = $(this).attr('notifId');
                if (typeof id !== typeof undefined && id !== false) {
                    $.post( "<?php echo DIR_TO_HOOKS ?>notifSeen.php", {id: id} );
                    $(this).children('.notifHeader').children('.notifNew').text('')
                    $(this).children('.notifHeader').children('.notifNew').removeClass('label label-warning')
                    $(this).removeAttr('id notifId');
                    var val = $('#notifNCount').text();
                    if (val - 1 <= 0) {
                        $('#notifNCount').text(0);
                        $('#notifNCount').addClass('hidden');
                    } else {
                        $('#notifNCount').text(val-1);
                    }
                    $('#notifNCountText').text("Du hast "+(val-1)+" neue Benachrichtigungen");
                }
            });

            $('body').on('click', function (e) {
                if (!$('li.dropdown.messages-menu').is(e.target) 
                    && $('li.dropdown.messages-menu').has(e.target).length === 0 
                    && $('.open').has(e.target).length === 0
                ) {
                    $('li.dropdown.messages-menu').removeClass('open');
                }
            });

            if (logged) {
                loop_oBank();
            }
        });
    </script>
</head>
<body id="sidebar" class="hold-transition skin-black <?php echo (isset($_COOKIE['sideBarCollpased']))? 'sidebar-collapse': '';?> sidebar-mini">
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
    <?php if (isset($_SESSION['notifications']) && not_null($_SESSION['notifications'])): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            <?php
                for ($i = 0; $i < sizeof($_SESSION['notifications']); $i++) {
                    echo "alertify.notify('".$_SESSION['notifications'][$i]['message']."', '".$_SESSION['notifications'][$i]['type']."', ".$_SESSION['notifications'][$i]['timeout'].");";
                }
                unset($_SESSION['notifications']);
            ?>
        });
    </script>
    <?php endif; ?>
    <?php render_javascripts(true); ?>
    <?php if (file_exists (DIR_TEMPLATES . "/scripts/" . $DE100_GLOBALS['content'] . ".php")) : ?>
        <?php require(DIR_TEMPLATES . "/scripts/" . $DE100_GLOBALS['content'] . ".php"); ?>
    <?php endif; ?>
</body>
</html>