<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>>
<head>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?></title>


	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>?v=3.1" media="screen">
	<link rel="alternate" type="text/xml" title="<?php bloginfo('name'); ?> RSS 0.92 Feed" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<meta name="DC.title" content="<?php bloginfo('name'); ?>" />
    <meta name="DC.subject" content="<?php bloginfo('description'); ?>" />
    <meta name="DC.creator" content="Michiel Koning" />


	<?php wp_enqueue_script('jquery'); ?>
	<script type="text/javascript">
		var PROJECT_URL = '<?php bloginfo('template_url'); ?>/';
	</script>

	<script src="https://use.typekit.net/pcx5woz.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

	<?php wp_head(); ?>

	<!--[if lte IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-26574735-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header class="header">
	<h1 class="sitetitle"><?php bloginfo('name');?></h1>
	<nav class="menu">
		<ol>
			<li<?php if (is_front_page() || is_single()) : ?> class="current_page_item"<?php endif; ?>><a href="<?php bloginfo('wpurl'); ?>">News</a></li>
			<?php wp_list_pages('title_li=&exclude=9,152&depth=1&sort_column=menu_order'); ?>
		</ol>
	</nav>
	<div class="clear"></div>
</header>
<div class="clear"></div>
<div class="wrap">

