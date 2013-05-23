<script type="text/javascript">
	$(function(){
		$('.album-delete-button').click(function(e) {
			e.preventDefault();
			var $form = $(this).closest('.form-album-delete');
			if (confirm('Do you want to delete the album?')) {
				$.ajax({
					type: 'POST',
					url: $form.attr('action'),
					data: $form.serialize(),
				});
			}
		});		
	});

	
</script>

<h2>Your album list</h2>

<ul id="album-list">
	<?php foreach($albums as $album) :?>
		<li class="meta-target">
			<a href="<?php echo $this->Html->url(array('controller' => 'albums', 'action' =>'view', $album['Album']['id'])); ?>" title="View album">
				<?php echo $this->Html->image('/files/post/image/' . $album['IncludePost'][0]['image_dir'].'/' . $album['IncludePost'][0]['image']); ?>
			</a>
			<div class="meta transparent opacity-transition">
				<div class="tools float-right">
					<a href="<?php $this->Html->url(array('controller' => 'albums', 'action' => 'edit', $album['Album']['id'])); ?>" title="Edit">
						<span class="edit-button"></span>
					</a>
					<form class="form-album-delete inline no-margin" action="<?php echo $this->Html->url(array('controller' => 'albums', 'action' => 'delete', $album['Album']['id'])); ?>" method="post">
						<input type="hidden" name="id" value="<?php echo $album['Album']['id']; ?>">
						<input type="hidden" name="_method" value="POST">
						<a href="#" title="Delete" class="album-delete-button">
							<span class="delete-button"></span>
						</a>
					</form>
				</div>
				<div class="title">
					<a href="<?php echo $this->Html->url(array('controller' => 'albums', 'action' =>'view', $album['Album']['id'])); ?>" title="View album">
						<?php echo $album['Album']['title']; ?>
					</a>
				</div>
			</div>
		</li>
	<?php endforeach; ?>

</ul>