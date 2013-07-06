<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php echo wp_title(''); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url');?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('atom_url');?>" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<!--<script src="//raw.github.com/cowboy/jquery-hashchange/v1.3/jquery.ba-hashchange.min.js"></script>-->

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/style.css" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
<div class="container">
