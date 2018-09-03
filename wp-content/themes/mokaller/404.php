<?php get_header(); ?>	
	<?php include("includes/breadcrumb.php"); ?>
	<section class="pagina error-404">
		<img class="img-responsive" src="<?php bloginfo('stylesheet_directory'); ?>/img/bg/404.jpg" alt="" />				
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="contenido">
							<h1>404</h1>
							<?php 
							$args=array(
								'pagename'=>'error-404',
								'post_type'=>'page',
								'post_parent'=>'0'
							);
							$query=new WP_Query($args);
							while ( $query->have_posts() ) : $query->the_post();
							?>
							<?php the_content(); ?>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>	