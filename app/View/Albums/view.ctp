<script type="text/javascript">
	$(function(){
		$('.post-delete-button').click(function(e) {
			e.preventDefault();
			var $form = $(this).closest('.form-post-delete');
			var $liPost = $(this).closest('li');

			var successFunc = function() {
				$liPost.remove();
			}
			if (confirm('Do you want to delete the post?')) {
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: $form.serialize(),
					success: successFunc
				});
			}
		});		
	});

</script>

<div id="post-sidebar">
	<!-- Here is region to populate all post in the same album -->
	<div class="owner">
		<h3>Author</h3>
		<div class="ava-thumb">
			<?php echo $this->Html->image("/files/user/avatar/" . $album['User']['avatar_dir']. "/" . $album['User']['avatar']); ?>
		</div>
		<div class="info">
			<?php echo $this->Html->link($album['User']['username'], array('controller' => 'users', 'action' => 'view', $album['User']['id']))?>
			<div>
				<em>Created at</em> <?php echo $album['Album']['created'];?>
			</div>
		</div>
		
	</div>

	<div class="post-related">
		<h3>Other related albums</h3>
		<ul>
			<?php foreach ($relatedAlbums as $relatedAlbum): ?>
				<?php if (!empty($relatedAlbum['IncludePost'][0])):?>
				<li>
					<a href="<?php echo $this->Html->url(array('controller' => 'albums', 'action' => 'view', $relatedAlbum['Album']['id'])); ?>" title="<?php echo $relatedAlbum['Album']['title']; ?>">
						<?php echo $this->Html->image('/files/post/image/'.$relatedAlbum['IncludePost'][0]['image_dir'].'/'.$relatedAlbum['IncludePost'][0]['image']); ?>
					</a>
				</li>
				<?php endif;?>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<div class="post-content">
	<h2><?php echo $album['Album']['title']; ?></h2>
	<div id="post-action">
		<div id="facebook-like">
			<?php echo $this->Facebook->like(); ?>
		</div>

		<div>
			<?php
				if ($album['Album']['user_id'] == $user['id']) {
					echo $this->Html->link('Edit', array('controller' => 'albums', 'action' => 'edit', $album['Album']['id']));
					echo '&nbsp;';
					echo $this->Form->postLink('Delete', array('controller' => 'albums', 'action' => 'delete', $album['Album']['id']), array('confirm' => "Do you want to delete this post?"));
				}
			?>
		</div>
		
	</div>

	<ul id="album-post-list">
		<?php foreach($album['IncludePost'] as $post) :?>
		<li class="meta-target"><?php echo $this->Html->image('/files/post/image/' . $post['image_dir']. '/' . $post['image']); ?>
			<div class="meta transparent opacity-transition">
				<?php if($album['Album']['user_id'] == $user['id']) :?>
				<div class="tools float-right">
					<a
						href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>"
						title="Edit"> <span class="edit-button"></span>
					</a>
					<form class="form-post-delete inline no-margin"
						action="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'delete', $post['id'])); ?>"
						method="post">
						<input type="hidden" name="id"
							value="<?php echo $post['id']; ?>"> <input
							type="hidden" name="_method" value="POST"> <a href="#"
							title="Delete" class="post-delete-button"> <span
							class="delete-button"></span>
						</a>
					</form>
				</div>
				<?php endif;?>
				<div class="title">
					<a
						href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' =>'view', $post['id'])); ?>"
						title="View post"> <?php echo $post['title']; ?>
					</a>
				</div>
				<div class="owner-block">
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $album['Album']['user_id'])); ?>">
						<?php echo $album['User']['username']; ?>						
					</a>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>

	<div id="facebook-comments">
		<?php echo $this->Facebook->comments(); ?>
	</div>
</div>

