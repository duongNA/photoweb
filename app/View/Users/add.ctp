<?php
echo "Registration Form";
echo $this->Form->create('User',array('type'=>'file'));
echo $this->Form->input('User.username');
echo $this->Form->input('User.password');
echo $this->Form->input('User.email');
echo $this->Form->input('User.avatar',array('type'=>'file'));
echo $this->Form->input('User.about_me',array('rows'=>4));
echo $this->Form->end(__('Register'));
