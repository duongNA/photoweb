<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Post',array('type'=>'file'));
    echo $this->Form->input('title');
    echo $this->Html->image("/files/post/image/".$this->request->data['Post']['image_dir']."/".$this->request->data['Post']['image']);
    echo $this->Form->input('image',array('type'=>'file'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    // echo $this->Form->input('Album.title');
    // echo $this->Form->input('Album.id',array('type'=>'hidden'));
    echo $this->Form->end('Save Post');
