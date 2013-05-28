<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $cakeDescription ?>: <?php echo $title_for_layout; ?>
</title>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php
echo $this->Html->meta('icon');


echo $this->Html->css('cake.generic');
echo $this->Html->css('blitzer/jquery-ui-1.10.2.custom');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');

echo $this->Html->script('jquery-1.7.1.min.js');
echo $this->Html->script('jquery-ui-1.10.2.custom.js');

echo $this->Html->script('jquery.masonry.js');
echo $this->Html->script('jquery.isotope.js');
echo $this->Html->script('jquery.infinitescroll.min.js');
echo $this->Html->script('script');

// fancybox lib
echo $this->Html->script('fancybox/lib/jquery.mousewheel-3.0.6.pack.js');

// fancybox
echo $this->Html->script('fancybox/source/jquery.fancybox.pack.js');
echo $this->Html->css('fancybox/source/jquery.fancybox');

// 		echo $this->Html->script('jquery.masonry.min');
// 		echo $this->Html->script('modernizr-2.5.3.min');
// 		echo $this->Html->script('script');
// 		echo $this->Html->script('jquery.infinitescroll.min');
?>
</head>
<body>
	<div id="container">
		<div id="header">
			<ul>
				<li class="logo">
					<a href="">
						<span></span>
						<b>Photos</b>
					</a>
				</li>
				<li class="avatar">
					<?php $id = $this->Session->read('Auth.User.id');?>
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $id)); ?>">
						<span class="avatar-bound">
							<?php $avatar_name = $this->Session->read('Auth.User.avatar'); ?>
							<?php $avatar_dir = $this->Session->read('Auth.User.avatar_dir');?>
							<?php echo $this->Html->image("/files/user/avatar/" . $avatar_dir . "/" . $avatar_name, array('width' => '30px', 'height' => '30px')); ?>
						</span>
						<b><?php echo $this->Session->read('Auth.User.username'); ?></b>
					</a>
				</li>
				<li class="add-post">
					<a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'add'));?>">
						<span></span>
						<b>Add post</b>
					</a>
				</li>
				<li class="my-album">
					<a href="<?php echo $this->Html->url(array('controller' => 'albums', 'action' => 'index', $id));?>">
						<span></span>
						<b>My Albums</b>
					</a>
				</li>
				<li class="my-post">
					<a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'index', $id));?>">
						<span></span>
						<b>My Posts</b>
					</a>
				</li>


				<li class="new">
					<a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'browse')); ?>">
						<span></span>
						<b>New</b>
					</a>
				</li>
				<li class="popular">
					<a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'popular')); ?>">
						<span></span>
						<b>Popular</b>
					</a>
				</li>

				<li class="search-button">
					<form action="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'search')); ?>" method="get" id="nav_search">
					<a href="#">
						<span></span> 
							<input type="text" name="keyword" autocomplete="off" placeholder="Search">
							<input type="submit" value="Search" style="display: none">
					</a>
					</form>
				</li>
				<li class="power">
					<?php if ($this->Session->check('Auth.User')): ?>
						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>">
							<span></span>
							<b>Logout</b>
						</a>
					<?php else: ?>
						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">
							<span></span>
							<b>Login</b>
						</a>
					<?php endif; ?>
				</li>

				<?php if($this->Session->read('Auth.User.role') == 'admin'): ?>
				<li class="manage-user">
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'manage')); ?>">
						<span></span>
						<b>Manage users</b>					
					</a>
				</li>
				<li class="manage-posts">
					<a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'manage'));?>">
						<span></span>
						<b>Manage posts</b>					
					</a>
				</li>
				<?php endif;?>
			</ul>
		</div>
		<div id="header-space"></div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
<!-- 		<div id="footer"> -->
			<?php // echo "Copyright © 2013, Group 9. All rights reserved"?>
<!--  		</div>  -->

	</div>
	<!-- <?php echo $this->element('sql_dump'); ?> -->
	<?php echo $this->Facebook->init(); ?>
</body>
</html>
