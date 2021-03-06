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
		<div id="header-space"></div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

	</div>
	<?php echo $this->Facebook->init(); ?>
</body>
</html>
