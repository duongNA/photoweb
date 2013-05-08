<h2>Your album list</h2>

<ul id="album-list">
	<?php foreach($albums as $album) :?>
		<li>
			<div class="album-title" style="display: none">
				<?php echo $album['Album']['title']; ?>
			</div>
			<?php echo $this->Html->image('/files/post/image/' . $album['IncludePost'][0]['image_dir'].'/' . $album['IncludePost'][0]['image']); ?>
		</li>
	<?php endforeach; ?>

</ul>