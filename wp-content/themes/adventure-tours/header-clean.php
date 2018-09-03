<?php
/**
 * Header clean template part.
 *
 * @author    Themedelight
 * @package   Themedelight/AdventureTours
 * @version   2.3.1
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( ! adventure_tours_check( 'is_wordpress_seo_in_use' ) ) {
		printf( '<meta name="description" content="%s">', get_bloginfo( 'description', 'display' ) );
	} ?>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
	<!-- Facebook Pixel Code -->
	<script type="text/javascript">
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '218098878730356'); 
		fbq('track', 'PageView');
	</script>
	<noscript>
		 <img height="1" width="1" src="https://www.facebook.com/tr?id=218098878730356&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="layout-content">
