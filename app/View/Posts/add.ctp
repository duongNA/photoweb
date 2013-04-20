<?php
echo $this->Form->create('Post',array('type'=>'file'));

echo $this->Form->input('Post.title', array('label'=>'Post title'));
echo $this->Form->input('Post.image',array('type'=>'file','label'=>'Upload'));

// If album_id is not present -> will create new album
if(!$this->request->pass){
  echo $this->Form->input('Album.title',array('label'=>'Album title'));
} else{
echo 'Album title : ';
echo $this->request->pass[1];
echo "<br>";
echo $this->Form->input('Album.id',array('type'=>'hidden','value'=>$this->request->pass[0]));
}
echo $this->Form->submit(__('Create Post'));
