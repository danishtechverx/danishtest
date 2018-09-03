<section class="especial">
	<div class="container-fluid">
		<div class="row row-eq-height">
			<div class="col-md-8 nopd">
				<?php 
				$args=array(
					'pagename'=>'bereit-fuer-reisen',
					'post_type'=>'page',
					'post_parent'=>'0'
				); 
				$query=new WP_Query($args);
				
				if($query->have_posts()){ ?>
				<div class="promo">
					<div class="leyenda">
						<div class="row">
							<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
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
				<?php } ?>
				<?php wp_reset_postdata(); ?>
			</div>
			<div class="col-md-4 nopd">
				<?php 
				$args=array(
					'pagename'=>'do-you-have',
					'post_type'=>'page',
					'post_parent'=>'0'
				); 
				$query=new WP_Query($args);
				
				if($query->have_posts()){ ?>
				<div class="banner">
					<div class="leyenda">
						<div class="row">
							<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1">
								<?php while ($query->have_posts()) : $query->the_post();
									$boton=get_field('button_text');
								?>
								<div class="contenido">
									<p class="title"><?php the_title(); ?></p>
									<?php the_content(); ?>
									<a href="<?php echo get_the_permalink(get_page_by_path('kontakt')); ?>" class="boton azul"><span><?php echo $boton; ?></span></a>
								</div>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>