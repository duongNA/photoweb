

<!-- Here is region to populate all post in the same album -->
<div class="post-related">
	<?php foreach($related as $p): ?>
	<?php echo $this->Html->image('/files/post/image/'.$p['Post']['image_dir'].'/'.$p['Post']['image'])."<br>"; ?>
	<?php endforeach ?>
</div>

<div class="post">
<div class="post-image">
	<?php echo $this->Html->image('/files/post/image/'.$post['Post']['image_dir'].'/'.$post['Post']['image']); ?>
</div>

<div class="owner">
	<div class="ava-thumb">
		<?php echo $this->Html->image("/files/user/avatar/".$post['PostOwner']['avatar_dir']."/".$post['PostOwner']['avatar']) ?>
	</div>
	<div class="info">
		<h1 id="title"><?php echo $post['Post']['title']; echo '<br>'; ?> </h1>
		<h1 id="user-name"><?php echo 'By: '; echo $post['PostOwner']['username'] ?></h1>
	</div>
</div>

<div id="facebook-like">
	<?php echo $this->Facebook->like(); ?>
</div>

<div id="facebook-comments">
	<?php echo $this->Facebook->comments(); ?>
</div>
</div>

