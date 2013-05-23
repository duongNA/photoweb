
<div id="post-sidebar">
	<!-- Here is region to populate all post in the same album -->
	<div class="owner">
		<h3>Author</h3>
		
		<div class="ava-thumb">
			<?php echo $this->Html->image("/files/user/avatar/".$post['PostOwner']['avatar_dir']."/".$post['PostOwner']['avatar']) ?>
		</div>
		<div class="info">
			<?php echo $this->Html->link($post['PostOwner']['username'], array('controller' => 'users', 'action' => 'view', $post['PostOwner']['id']))?>
			<div>
				<em>posts at</em> <?php echo $post['Post']['created'];?>
			</div>
		</div>
		
	</div>

	<div class="post-related">
		<h3>Images in the same album</h3>
		<ul>
			<?php foreach ($related as $relatedPost): ?>
				<li>
					<a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $relatedPost['Post']['id'])); ?>" title="<?php echo $relatedPost['Post']['title']; ?>"> 
						<?php echo $this->Html->image('/files/post/image/'.$relatedPost['Post']['image_dir'].'/'.$relatedPost['Post']['image']); ?>
					</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<div class="post-content">
	<h2><?php echo $post['Post']['title']; ?></h2>
	<div id="post-action">
		<div id="facebook-like">
			<?php echo $this->Facebook->like(); ?>
		</div>

		<div>
			<?php
				if ($post['Post']['user_id'] == $user['id']) {
					echo $this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']));
					echo '&nbsp;';
					echo $this->Form->postLink('Delete', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), array('confirm' => "Do you want to delete this post?"));
				}
			?>
		</div>
		
	</div>
	<div class="post-image">
		<?php echo $this->Html->image('/files/post/image/'.$post['Post']['image_dir'].'/'.$post['Post']['image']); ?>
	</div>

	

	<div id="facebook-comments">
		<?php echo $this->Facebook->comments(); ?>
	</div>
</div>

