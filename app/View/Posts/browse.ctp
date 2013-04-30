<div id="container">
	<?php foreach ($posts as $post): ?>
	<div class="box">
		<?php echo $this->Html->image("/files/post/image/".$post['Post']['image_dir']."/".$post['Post']['image']); ?>
	</div>
	<?php endforeach; ?>

</div>

<nav id="page_nav">
	<?php 
  		if($this->Paginator->hasPage(2)) {
	 		echo $this->Paginator->next('Next Page');
	 	}	
  	?>
</nav>


