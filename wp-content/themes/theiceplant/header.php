<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="Description" content="The Ice Plant is a publishing house based in Los Angeles, producing artist books and other printed matter since 2006." />
<meta name="Keywords" content="ice, plant, books, publisher, art, photography, photobooks, artist books, Los Angeles, Mike Slack, OK , Scorpio, Pyramids, polaroid, Jason Fulford, Raising Frogs,notes, Ron Jude, emmett, Other Nature, Pat O'Neill, Another Kind of Record, Charles Gute, Revisions, Queries, C'est le PIed, Tamara Shopsin, Ed Panar, Animals that Saw Me, Charlotte Dumas, Retrieved, search dogs, rescue dogs, seth lower, sun shone glaringly, found rolling stones, bad luck, hot rocks, Jacques Marlow" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-25549044-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php wp_head(); ?>
</head>

<body <?php body_class( 'class-name' ); ?>>

<header>
	<div id="TheIcePLant">
	<a href="/"><img class="title" src="<?php echo get_template_directory_uri() ?>/assets/images/title.png" name="TheIcePlant" width="26" height="160" border="0" id="TheIcePlant" /></a>
	</div>

	<div>
		<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>"> <img src="<?php echo get_template_directory_uri() ?>/assets/images/LOGO_anm.gif" alt="The Ice Plant LOGO" name="TheIcePlant_LOGO" width="80" height="80" border="0" id="TheIcePlant_LOGO"/></a>
	</div>

	<div id="MainMenu">
		<?php wp_nav_menu(); ?>
	</div>
</header>