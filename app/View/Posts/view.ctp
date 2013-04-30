<h1><?php echo $post['Post']['title']; echo '<br>'; ?> </h1>
<h1><?php echo 'Viewed:'; echo $post['Post']['viewed'] ?></h1>


<div class="post-image">
	<?php echo $this->Html->image('/files/post/image/'.$post['Post']['image_dir'].'/'.$post['Post']['image']); ?>
</div>

<div id="facebook-comments">
	<?php echo $this->Facebook->comments(); ?>
</div>

<div id="facebook-like">
	<?php echo $this->Facebook->like(); ?>
</div>