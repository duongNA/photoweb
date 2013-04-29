<div class="users form">

	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>

	<fieldset>

		<legend>
			<?php echo __('Please enter your username and password'); ?>
		</legend>

		<?php echo $this->Form->input('username');
		echo $this->Form->input('password');
		?>

	</fieldset>

	<?php echo $this->Form->end(__('Login')); ?>
</div>

<div>

	<?php
		if ($facebook_user) {
			echo $this->Facebook->disconnect(array('redirect' => '/users/logout'));
// 			echo $this->Facebook->logout();
			debug($facebook_user);
			debug($user);
		} else {
			echo $this->Facebook->login(array('perms' => 'email,publish_stream'));
		}
	?>
</div>


