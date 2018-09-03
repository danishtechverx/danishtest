<?php 
$args=array(
	'pagename'=>'bereit-fuer-reisen',
	'post_type'=>'page',
	'post_parent'=>'0'
); 
$query=new WP_Query($args);

if($query->have_posts()){ ?>
<section class="promo">
	<img class="punta" src="<?php bloginfo('stylesheet_directory'); ?>/img/punta.png" alt="" />
	<div class="leyenda">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php while ($query->have_posts()) : $query->the_post();
						$boton=get_field('button_text');
					?>
					<div class="contenido">
						<p class="title"><?php the_title(); ?></p>
						<?php the_content(); ?>
						<a href="<?php echo get_the_permalink(get_page_by_path('kontakt')); ?>" class="boton"><span><?php echo $boton; ?></span></a>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>
<?php wp_reset_postdata(); ?>