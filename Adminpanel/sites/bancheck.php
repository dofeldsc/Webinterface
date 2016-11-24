<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$baninfo = Player::banData(Input::get('id'));

function toData($number){
    if ($number < 0) {
        return "Permanent";
    }
    $number = str_split($number);
    $year = implode(array_slice($number,0,4));
    $month = implode(array_slice($number, 4,2));
    $day = implode(array_slice($number,6,2));
    $hr = implode(array_slice($number,8,2));
    $min = implode(array_slice($number,10,2));
    
    return $day.".".$month.".".$year." ".$hr.":".$min." Uhr";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
<title>Ban-Check | DE100</title>
<meta name="robots" content="noindex, nofollow"> 
<?php render_stylesheets(); ?>
<style type="text/css">
body {
font:12px/18px "Lucida Grande","Lucida Sans Unicode",Helvetica,Arial,Verdana,sans-serif;
background-color:#55442c;
color:#333;
margin: 0;
padding: 0;
}
article {

margin-top:3%;
margin-left:auto;
margin-right:auto;
margin-bottom:12px;
width:700px;
min-height: 70px;
padding: 1em;
background-color:#fff;
border-radius: 5px 5px 5px 5px !important;
box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
text-align: center;
}
footer {
text-align:center;
color:rgb(136, 136, 136);
font-size:10px !important;
margin-top:10px;
margin-bottom:10px;
}
footer a,footer a:active,footer a:visited {
text-decoration:none;
color:rgb(136, 136, 136);
}
footer a:hover {
text-decoration:underline;
}
a,a:active,a:visited {
color:#176fa1;
text-decoration:none;
}
a:hover {
text-decoration:underline;
}
</style>
</head>
<body>
    <div class="container">
        <div class="row">
                <img src="http://forum.de100-altis.life/styles/prosilver/theme/images/logo.png" class="col-centered col-xs-4 col-xs-offset-4"></img>
        </div>
        <article>
        <div class="row">
            <h3 class="col-xs-12"><strong>Ban-Informationen</strong></h3>
            <h4 class="col-xs-5 text-left">
                <strong>Dein Spieler-Name:</strong><br>
                <?php echo $baninfo['name']; ?><br><br>
                <strong>Dein Spieler-ID:</strong><br>
                <?php echo $baninfo['playerid']; ?><br><br>
                <strong>Gebannt von:</strong><br>
                <?php echo $baninfo['von']; ?><br><br>
                <strong>Gebannt bis:</strong><br>
                <?php echo toData($baninfo['datum']); ?><br><br>
                <strong>Ban-Status:</strong><br>
                <?php echo ($baninfo['status'] == 'true')? "<span class='text-red'>Gebannt</span>" : "<span class='text-green'>Entbannt</span>"; ?>
            </h4>
            <h4 class="col-xs-7 text-left">
                <strong>Grund:</strong><br>
                <?php echo $baninfo['grund']; ?><br>
            </h4>
            </div>
        </article>
    </div>
<footer>
    <span>
        <a href="http://www.de100-altis.life/impressum/">Impressum</a>
    </span>
    |
    <span>
        &copy; 2016 by <a href="de100-altis.life">DE100</a>
    </span> 
</footer>
</body>
</html>
