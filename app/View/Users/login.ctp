<div class="login">
<div class="fb-login">
	<?php
		if ($facebook_user) {
			echo $this->Facebook->disconnect(array('redirect' => '/users/logout'));
		} else {
			echo $this->Facebook->login(array('perms' => 'email,publish_stream'));
		}
	?>
</div>

<div class="site-login">

	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>

	<fieldset>

		<legend>
			<?php echo __('Already a member?'); ?>
		</legend>

		<?php echo $this->Form->input('username');
		echo $this->Form->input('password');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Login')); 
	echo "Not registered yet? "; echo $this->Html->link("Register here",array('controller'=>'users','action'=>'add'));
	?>

</div>
</div>
