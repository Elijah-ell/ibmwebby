<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <!-- <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->

		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Raleway:300,400,700" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/plugins/js_composer/assets/css/js_composer.min.css" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">



		<?php wp_head(); ?>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });

		// logout link
		var logoutlink = "<?php echo wp_logout_url( $redirect ); ?>";

		// home_url
		var home_url = "<?php echo home_url(); ?>";
        </script>

	</head>
	<body <?php body_class(); ?> id="body-style">

		<!-- wrapper -->
		<div class="wrapper bg-image">

			<!-- header -->
			<header class="header clear" role="banner">


					<div class="member-actions">
						<a href="<?php echo home_url(); ?>/profile ">My Ticket</a>
						<a href="<?php echo wp_logout_url( home_url() ); ?> ">Logout</a>
					</div>

			</header>
			<!-- /header -->
