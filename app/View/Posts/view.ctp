

<!-- Here is region to populate all post in the same album -->
<div class="post-related">
	<table>
		<tr class="rows-1">
			<?php
			if(count($related)>0){
			 	echo "<td>";
		 	  	echo $this->Html->image('/files/post/image/'.$related[0]['Post']['image_dir'].'/'.$related[0]['Post']['image'])."<br>";
		 	  	echo "</td>";
		 	}

			if(count($related)>1){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[1]['Post']['image_dir'].'/'.$related[1]['Post']['image'])."<br>";
				echo "</td>";
			}

			if(count($related)>2){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[2]['Post']['image_dir'].'/'.$related[2]['Post']['image'])."<br>";
				echo "</td>";
			}?>	
		</tr>

		<tr class="rows-2">
		<?php
			if(count($related)>3){
				echo "<td>"; 
			 	echo $this->Html->image('/files/post/image/'.$related[3]['Post']['image_dir'].'/'.$related[3]['Post']['image'])."<br>"; 
			 	echo "</td>";
			} 
			if(count($related)>=4){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[4]['Post']['image_dir'].'/'.$related[4]['Post']['image'])."<br>";
				echo "</td>";
			}	
			if(count($related)>5){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[5]['Post']['image_dir'].'/'.$related[5]['Post']['image'])."<br>";
				echo "</td>";
			}?>	
			
		</tr>
		<tr class="rows-3">
		<?php
			if(count($related)>6){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[6]['Post']['image_dir'].'/'.$related[6]['Post']['image'])."<br>";
				echo "</td>";
			}
			if(count($related)>7){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[7]['Post']['image_dir'].'/'.$related[7]['Post']['image'])."<br>"; 
				echo "</td>"; 
			}
			if(count($related)>8){
				echo "<td>"; 
				echo $this->Html->image('/files/post/image/'.$related[8]['Post']['image_dir'].'/'.$related[8]['Post']['image'])."<br>";
				echo "</td>";
			}?>	
		</tr>
	</table>	
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
		<h1 id="user-name"><?php echo 'By: '; echo $this->Html->link($post['PostOwner']['username'],array('controller'=>'users','action'=>'view',$post['PostOwner']['id']));?></h1>
	</div>
</div>

<div id="facebook-like">
	<?php echo $this->Facebook->like(); ?>
</div>

<div id="facebook-comments">
	<?php echo $this->Facebook->comments(); ?>
</div>
</div>

