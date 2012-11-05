<!DOCTYPE html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="description" content="Cargo Media AG, Basel" />
	<meta name="keywords" content="Cargo Media AG, cargo, media, jobs, webfactory, web development" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	?></title>
	<link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/img/favicon.ico" type="image/x-icon" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Bad+Script' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/css/reset.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/style.css" />

	<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="js/cargo.js" type="text/javascript"></script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
</head>









<link rel="stylesheet" type="text/css" href="css/styles.css">

<title>Cargo Media AG</title>

<body>
	<header>
		<div class="sheet">
			<a href="/" class="logo">
				<div class="sign">
					<div class="ball b1"></div>
					<div class="ball b2"></div>
					<div class="ball b3"></div>
					<div class="ball m1"></div>
					<div class="ball m2"></div>
					<div class="ball m3"></div>
					<div class="ball t1"></div>
					<div class="ball t2"></div>
					<div class="ball t3"></div>
				</div>
				<div class="text"><span>CARGO</span><span>media</span></div>
			</a>
			<nav id="access" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav>
		</div>
	</header>

	<section id="main">
