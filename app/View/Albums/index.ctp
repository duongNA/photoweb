<h2>Your album list</h2>

<ul id="album-list">
	<?php foreach($albums as $album) :?>
		<li>
<!-- 			<div class="album-title"> -->
				<?php //echo $album['Album']['title']; ?>
<!-- 			</div> -->
			
			<a href="<?php echo $this->Html->url(array('controller' => 'albums', 'action' =>'view', $album['Album']['id'])); ?>" title="View album">
				<?php echo $this->Html->image('/files/post/image/' . $album['IncludePost'][0]['image_dir'].'/' . $album['IncludePost'][0]['image']); ?>
			</a>
			<div class="meta">
				<span class="title">
					<?php echo $album['Album']['title']; ?>
				</span>
				<div class="tools">
					<a href="<?php $this->Html->url(array('controller' => 'albums', 'action' => 'edit', $album['Album']['id'])); ?>" title="Edit">
						<span class="edit-button"></span>
					</a>
					<a href="" title="Edit">
						<form action="<?php $this->Html->url(array('controller' => 'albums', 'action' => 'edit', $album['Album']['id'])); ?>" method="post"> 
							<span class="delete-button"></span>
						</form>
					</a>

				</div>
			</div>
		</li>
	<?php endforeach; ?>

</ul>