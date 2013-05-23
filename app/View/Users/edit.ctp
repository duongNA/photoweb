<h2>Update profile</h2>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username', array('class' => 'medium'));
echo $this->Form->input('password', array('class' => 'medium'));
echo $this->Form->input('email', array('class' => 'medium'));
echo $this->Html->image("/files/user/avatar/".$this->request->data['User']['avatar_dir']."/".$this->request->data['User']['avatar']);
echo $this->Form->input('avatar',array('type'=>'file'));
echo $this->Form->input('about_me',array('rows'=>'3', 'cols' => '40', 'style' => 'width: 400px', 'class' => 'medium'));
echo $this->Form->end(__('Save'));
