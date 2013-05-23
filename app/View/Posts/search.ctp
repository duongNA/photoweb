<form
	action="<?php $this->Html->url(array('controller' => 'posts', 'action' => 'search')); ?>"
	method="get">
	<input type="text" name="keyword" value="<?php echo $keyword; ?>"
		class="short"> <input type="submit" value="Search">
</form>

<h2 class="search-result">
	Search result:
	<?php echo count($posts); ?>
	post(s)
</h2>
<ul id="post-search-result">
	<?php foreach($posts as $post): ?>
	<li>

		<div class="image-post-search">
			<a
				href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view' , $post['Post']['id']));?>"
				title="<?php echo $post['Post']['title']; ?>"> <?php echo $this->Html->image('/files/post/image/' . $post['Post']['image_dir']. '/' . $post['Post']['image']); ?>
			</a>
		</div>

		<div class="details">
			<span class="field">Title: </span> <a
				href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view' , $post['Post']['id']));?>"
				title="<?php echo $post['Post']['title']; ?>"> <?php echo $post['Post']['title'];?>
			</a> <br /> <span class="field">Owner: </span> <a
				href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $post['PostOwner']['id']));?>">
				<?php echo $post['PostOwner']['username'];?>
			</a>
		</div>
	</li>
	<?php endforeach;?>
</ul>

