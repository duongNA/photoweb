<?php
echo "<h1>Update profile</h1>";
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('email');
echo $this->Html->image("/files/user/avatar/".$this->request->data['User']['avatar_dir']."/".$this->request->data['User']['avatar']);
echo $this->Form->input('avatar',array('type'=>'file'));
echo $this->Form->input('about_me',array('rows'=>'3'));
echo $this->Form->end(__('Save'));
