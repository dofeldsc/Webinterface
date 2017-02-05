<?php
require(dirname(dirname(__FILE__)) . '/includes/bootstrap.php');
$user = new User();
$Gang = new Gang(Input::get('id'));
$gangData = $Gang->data();
if (!$gangData) {
	redirect(DE100_DOMAIN,"Die Gang konnte nicht gefunden werden",MSG_TYPE_ERROR);
}
function deepSearch ($pid='',$array=[])
{
	foreach ($array as $key => $value) {
		if ($pid == $value[0]) {
			return $key;
		}
	}
	return false;
}

$members = toPhpArray($gangData['members']);
if (Input::get('action')) {
    switch(Input::get('action')){
        case 'kick':
        		if (!$user->hasPermision("GangMember")) {
                    redirect(DE100_DOMAIN,"Dafür hast du nicht die Berechtigung",MSG_TYPE_ERROR);
                }
        		if ($members[Input::get('index')][0] == Input::get('pid')) {
                	unset($members[Input::get('index')]);
					add_message("Der Spieler ".Player::nameFromPID(Input::get('pid'))." wurde aus der Gang ".$gangData["name"]." entfernt.", MSG_TYPE_SUCCESS);
					$Gang->updateMembers($members);
					Logger::addLog("gangEdit",$gangData['id'],"Der Spieler ".Player::nameFromPID(Input::get('pid'))." wurde aus der Gang entfernt.");
        		} else if (deepSearch(Input::get('pid'),$members)) {
        			unset($members[deepSearch(Input::get('pid'),$members)]);
        			add_message("Der Spieler ".Player::nameFromPID(Input::get('pid'))." wurde aus der Gang ".$gangData["name"]." entfernt.", MSG_TYPE_SUCCESS);
        			$Gang->updateMembers($members);
        			Logger::addLog("gangEdit",$gangData['id'],"Der Spieler ".Player::nameFromPID(Input::get('pid'))." wurde aus der Gang entfernt.");
        		} else {
        			add_message("Der Spieler ".Player::nameFromPID(Input::get('pid'))." scheint nicht mehr in der Gang zu sein.", MSG_TYPE_ERROR);
        		}
            break;
    }
    redirect(DIR_TO_SITES ."editgang?id=".Input::get('id'));
}

if (Input::get('add_comment')) {
    $validate = new Validate();
    $validation = $validate->check($_POST, [
        'add_comment' => [ 'required' => true, 'max' => 2000 ]
    ]);
    if (!$validation->passed()) {
        foreach ($validation->errors() as $error) {
            add_message($error, MSG_TYPE_ERROR);
        }
    } else {
        $Gang->addComment(Input::get('add_comment'),$user->data()['id']);
    }
}

if (Input::get('remove_comment')) {
    $Gang->removeComment(Input::get('remove_comment'),$user->data()['id']);
    redirect(DIR_TO_SITES ."editgang?id=".$gangData['id']);
}

$DE100_GLOBALS['content'] = "editgang";
$DE100_GLOBALS['title'] = $gangData['name'] . " bearbeiten - " .DE100_SITE_NAME;
$DE100_GLOBALS['permission'] = "GangEdit";
require(DIR_TEMPLATES . $DE100_GLOBALS['layout'] . ".php");
?>
