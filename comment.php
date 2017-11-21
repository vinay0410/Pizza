<?php
 //$m =new MongoDB\Client("mongodb://vinay0410:Qh4tPdg3!@ds123725.mlab.com:23725/pizza");
$m =new MongoDB\Client;
 $db = $m->pizza;
 $collection = $db->feedback;
 $cursor = $collection->find()->toArray();
 ?>
<h2 class="text-uppercase text-center">feedback</h2>

	<div class="comments-container">

		<ul id="comments-list" class="comments-list">

			<?php foreach (array_reverse($cursor) as $document) { ?>

			<li>
				<div class="comment-main-level">
					<div class="comment-avatar"><img src="https://cdn.vectorstock.com/i/thumb-large/48/33/human-man-user-profile-avatar-glyph-icon-vector-10704833.jpg" alt=""></div>
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><a href="#"><?php echo ucwords($document["name"]); ?></a></h6>

						</div>
						<div class="comment-content">
							<strong><?php	echo $document["subject"] . "\n"; ?></strong><br/>
						<?php	echo $document["message"] . "\n"; ?>
						</div>
					</div>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
