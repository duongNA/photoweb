<?php
echo $this->Form->create();
echo $this->Form->input('User.id',array('type'=>'hidden'));
echo $this->Form->input('User.oldpass',array('label'=>'Old password'));
echo $this->Form->input('User.newpass',array('label'=>'New password'));
echo $this->Form->input('confirmpass',array('label'=>'Comfirm new password'));
echo $this->Form->end('Change pass');
