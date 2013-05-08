<script type="text/javascript">
	$(function() {
		// hide menu bar and footer
		$('#header, #footer').hide();

		$('#container').css('background-color', '#F4F4F4');
		$('#content').css('padding-left', '0');
		$('#flashMessage').css('text-align', 'center');
	});
</script>
<style type="text/css">
#form-panel {
	text-align: left
}

#form-panel div.input {
	margin-bottom: 20px;
}

</style>


<div id="form-panel">
<h1>Register new account</h1>
<?php
echo $this->Form->create('User',array('type'=>'file'));
echo $this->Form->input('User.username', array('placeholder' => 'username'));
echo $this->Form->input('User.password', array('placeholder' => 'password'));
echo $this->Form->input('User.email', array('placeholder' => 'email@mail'));
echo $this->Form->input('User.gender', array(
			'type' => 'select',
			'options' => array(
				'' => '-Choose gender-',
				'male' => 'male',
				'female' => 'female'
			),
		));

echo $this->Form->input('User.avatar',array('type'=>'file'));
echo $this->Form->input('User.about_me',array('rows' => 4, 'placeholder' => 'Something you want to share?'));
echo $this->Form->end(__('Register'));
?>
</div>