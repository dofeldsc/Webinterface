<?php
foreach ($members as $value) {
    if (in_array("OWNER",$value[1])) {
       $gangOwner = $value[0];
       break;
    };
};
?>

<div class="content-header">
    <h1>Gang</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo DE100_DOMAIN ;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo DIR_TO_SITES ;?>gangs"> Gangs</a></li>
        <li class="active">
            <?php echo $gangData["name"];?>
        </li>
    </ol>
</div>
<div class="content">
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						<?php echo $gangData["name"];?>
					</h3>
				</div>
				<div class="box-body">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Besitzer</b> 
							<a href="<?php echo DIR_TO_SITES."editplayer?id=".Player::PIDtoUID($gangOwner);; ?>" class="pull-right"><?php echo Player::nameFromPID($gangOwner); ?></a>
						</li>
						<li class="list-group-item">
							<b>Mitglieder-Anzahl</b> <p class="pull-right"><?php echo count($members) ?></p>
						</li>
						<li class="list-group-item">
							<b>Gang-Level</b> <p class="pull-right"><?php echo $gangData["level"] ?></p>
						</li>
						<li class="list-group-item">
							<b>Gang-Skin</b> <p class="pull-right"><?php echo $gangData["skin"]? "Aktiviert":"Deaktiviert" ; ?></p>
						</li>
						<li class="list-group-item">
							<i class="glyphicon glyphicon-piggy-bank fa-lg"></i>
							<p class="pull-right">$<?php echo  number_format($gangData["bank"],0, ",", ".");?></p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">
						Mitglieder
					</h3>
				</div>
				<div class="box-body">
	                <table id="Members" class="table table-striped table-hover table-bordered">
	                    <thead>
	                        <tr>
	                        	<th>Spieler-ID</th>
	                            <th>Name</th>
	                            <th>Rechte</th>
	                            <?php if($user->hasPermision("GangMember")):?>
	                            <th><i class="fa fa-trash-o pull-right"></i></th>
	                        	<?php endif;?>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                        	foreach ($members AS $index => $member) {
	                        		$perm = (count($member[1]) == 0)? 'KEINE': implode(',', $member[1]);
	                        		echo "<tr>";
	                        		echo "<td><a target='_blank' href='".DIR_TO_SITES."editplayer?id=".Player::PIDtoUID($member[0])."'>".$member[0]."</a></td>";
	                        		echo "<td>".Player::nameFromPID($member[0])."</td>";
	                        		echo "<td>".$perm."</td>";
	                        		if($user->hasPermision("GangMember")) {
	                        			echo "<td><a href='" . DIR_TO_SITES . "editgang?id=" . $gangData['id'] . "&action=kick&index=".$index."&pid=".$member[0]."' title='Rauswerfen'><i class='fa fa-trash-o pull-right'></i></a></td>";
	                        		}
	                        		echo "</tr>";
	                        	}
	                        ?>
	                    </tbody>
	                </table>
				</div>
	            <div class="box-header with-border">
	            <hr>
	                <h3><i class="fa fa-comments"></i> Kommentare</h3>
	            </div>
	            <div class="box-footer box-comments">
	            <?php if($Gang->getComments()) { ?>
	            <?php foreach($Gang->getComments() as $comment):?>
	                <div class="box-comment">
	                    <img class="img-circle img-sm" src="<?php echo $user->getAvatar($comment['author_id']);?>" alt="User Image">
	                    <div class="comment-text">
	                        <span class="username">
	                            <?php echo $comment['author_name'] ?>
	                            <span class="text-muted pull-right"><?php echo date("d.m.Y H:i:s", strtotime($comment['date'])); ?> 
	                                <?php if($comment['author_id'] == $user->data()['id']): ?>
	                                    <span>&nbsp;|&nbsp;&nbsp;</span><a class="pull-right" href="<?php echo DIR_TO_SITES."editGang?id=".$gangData['id']."&remove_comment=".$comment['id'] ?>"><i class="fa fa-trash" title='Löschen'></i></a>
	                                <?php endif ?>
	                            </span>
	                        </span>
	                       <?php echo make_links_clickable($comment['text']) ?>
	                    </div>
	                </div>
	            <?php endforeach;?>
	            <?php } else {?>
	                <div class="box-comment">
	                    <div class="text-center">
	                        <h4>Keine Kommentare gefunden</h4>
	                    </div>
	                </div>
	            <?php }; ?>
	            </div>
	            <div class="box-footer">
	              <form method="post">
	                <img class="img-responsive img-circle img-sm" src="<?php echo $user->getAvatar();?>" alt="Alt Text">
	                <div class="img-push">
	                  <input type="text" class="form-control input-sm" name="add_comment" placeholder="Drücke Enter um eine Kommentar hinzuzufügen">
	                </div>
	              </form>
	            </div>
			</div>
		</div>
	</div>
</div>