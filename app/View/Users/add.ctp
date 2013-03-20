<?php
echo "Registration Form";
echo $this->Form->create('User',array('type'=>'file'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('email');
echo $this->Form->input('avatar',array('type'=>'file'));
echo $this->Form->input('about_me',array('rows'=>4));
echo $this->Form->end(__('Register'));
