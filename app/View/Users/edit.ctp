<?php
echo "<h1>Update profile</h1>";
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end(__('Save'));
