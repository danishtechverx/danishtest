	</div>
	<footer>
		<a style="display:none;" class="contactanos img-circle" href="<?php echo get_option('home'); ?>/kontakt/"><i class="far fa-envelope"></i></a>
		<div class="contenido">
			<div class="container">
				<div class="row row-eq-height">
					<div class="col-md-3">
						<div class="modulo">
							<?php dynamic_sidebar('sidebar-1'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<p class="widget-title">Reiseziele</p>
								<?php 
								$args=array(
									'menu'=>21,
									'menu_class'=>'smenu',
									'fallback_cb'=>false,
								);
								wp_nav_menu($args);
								?>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<p class="widget-title">MEHR ERFAHREN</p>
								<?php 
								$args=array(
									'menu'=>4,
									'menu_class'=>'smenu',
									'fallback_cb'=>false,
								);
								wp_nav_menu($args);
								?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="modulo ultimo">
							<?php dynamic_sidebar('sidebar-2'); ?>
							<div class="suscripcion">
								<?php echo do_shortcode('[yikes-mailchimp form="1"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bajada">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<p>© Mokaller <?php echo date('Y'); ?> All Rights Reserved</p>
					</div>
					<div class="col-md-6">
						<div class="clearfix">
							<?php 
							$args=array(
								'menu'=>5,
								'menu_class'=>'smenu',
								'fallback_cb'=>false,
							);
							wp_nav_menu($args);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>	
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-ui.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.sticky.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/sticky-kit.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/lightslider/lightslider.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap-tabcollapse.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.expander.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/select/bootstrap-select.min.js"></script>
	<?php if(is_archive('blog') or is_archive('tour')){ ?>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/jquery.isotope.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/jquery.imagesLoaded.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/jquery.transit.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/jquery.easing.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/waypoints.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/modernizr.custom.min.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/mediaboxes/jquery.mediaBoxes.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/grilla.js"></script>
	<?php } ?>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/funciones.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/validar.js"></script>
	<?php 
	if(is_singular('tours')){ 
		if($idioma=="en"){
	?>
	<script>
	$('.deslizable').expander({
		slicePoint:635,
		widow:2,
		expandText:'more',
		userCollapseText:'less'
	});
	</script>
	<?php } else{ ?>
	<script type="text/javascript">
	$('.deslizable').expander({
		slicePoint:635,
		widow:2,
		expandText:'mehr',
		userCollapseText:'weniger'
	});
	</script>
	<?php 
		} 
	}
	?>
	<?php wp_footer(); ?>
</body>
</html>