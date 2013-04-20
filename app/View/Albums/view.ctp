<div><?php
echo $album['Album']['title']; ?>
</div>

<div> <?php
echo $this->Form->postLink('Delete Album',array('action' => 'delete', $album['Album']['id']), array('confirm' => 'Delete album and all its included photo?'));
echo " ";
echo $this->Html->link('Add post',array('controller'=>'posts','action'=>'add',$album['Album']['id'],$album['Album']['title'])); ?>
</div>

<div>
  <?php
foreach ($album['IncludePost'] as $post) :
  if($post['status'] == 1) {
    echo $post['title'];
    echo $this->Html->image('/files/post/image/'.$post['image_dir'].'/'.$post['image']);
  }
endforeach
 ?> </div>



