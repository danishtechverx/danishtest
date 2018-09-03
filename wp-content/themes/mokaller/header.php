<?php 
if(!is_page('kontakt')){
	setcookie("ref","",time()-3600,"/");
}
if(is_singular('reiseziele')){
	setcookie("ref","",time()-3600,"/");
	setcookie("ref",$post->ID,time()+3600,"/");
}
if(is_singular('reisen')){
	setcookie("ref","",time()-3600,"/");
	setcookie("ref",$post->ID,time()+3600,"/");
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php wp_head(); ?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, shrink-to-fit=no">
	<title><?php wp_title('&laquo;', true, 'right'); ?></title>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Lato:300,400,700%7CRoboto:300,400,500,700">
	<link rel="stylesheet" type="text/css" media="all" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" media="all" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
	<link rel="stylesheet" type="text/css" media="all" href="https://use.fontawesome.com/releases/v5.0.8/css/regular.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/css/mediaBoxes.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/js/lightslider/lightslider.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/js/select/bootstrap-select.min.css">
	<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/icon/cropped-favicon-32x32.png" sizes="32x32" />
	<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/icon/cropped-favicon-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory'); ?>/img/icon/cropped-favicon-180x180.png" />
	<meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory'); ?>/img/icon/cropped-favicon-270x270.png" />
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-W3ZJSJB');</script>
	<!-- End Google Tag Manager -->  	
</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W3ZJSJB"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->  
	<header id="header">
		<div class="container-fluid">
			<div class="contenido">
				<div class="row">
					<div class="col-xs-7 col-sm-6 col-md-3">
						<a class="logo" href="<?php echo get_option('home'); ?>/"><img class="img-responsive" src="<?php bloginfo('stylesheet_directory'); ?>/img/logo.svg" alt="Mokaller"></a>
					</div>
					<div class="col-xs-5 col-sm-6 col-md-9">
						<div class="clearfix">
							<div class="menu-trigger">
								<span class="icon"></span>
							</div>
							<a class="contact" href="<?php echo get_option('home'); ?>/kontakt/"><i class="fas fa-comment"></i></a>
							<?php 
							$args=array(
								'menu'=>2,
								'menu_class'=>'menu',
								'fallback_cb'=>false,
							);
							wp_nav_menu($args);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-responsive" style="display:none;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<?php 
						$args=array(
							'menu'=>2,
							'menu_class'=>'menu',
							'fallback_cb'=>false,
						);
						wp_nav_menu($args);
						?>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div id="main">