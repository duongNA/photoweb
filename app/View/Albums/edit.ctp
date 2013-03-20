<?php
echo $this->Form->create('Album');
echo $this->Form->input('title');

foreach ($this->request->data['IncludePost'] as $post) {
  echo $this->Html->image('/files/post/image/'.$post['image_dir'].'/'.$post['image']);
}
echo $this->Form->input('id',array('type'=>'hidden'));
echo $this->Form->end(__('Save'));

