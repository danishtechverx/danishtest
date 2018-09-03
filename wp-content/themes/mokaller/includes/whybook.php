<?php 
$args=array(
	'pagename'=>'why-book-on-mokaller',
	'post_type'=>'page',
	'post_parent'=>'0'
); 
$query=new WP_Query($args);

if($query->have_posts()){ ?>
<section id="mwhybook">
	<div class="container">
		<div class="row">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
			<div class="col-md-12">
				<div class="titulo">
					<p class="title"><?php the_title(); ?></p>
				</div>
			</div>
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1">
				<?php if(have_rows('element')){?>
				<div class="iconos especial">
					<div class="row">
						<?php  while (have_rows('element')):the_row();
							$foto=get_sub_field('icon');
							if($foto){$foto=$foto['url'];}	
							$description=get_sub_field("description2");
						?>
						<div class="col-md-3">
							<div class="modulo">
								<div class="row">
									<div class="col-xs-4 col-sm-3 col-md-12 v-sm-3">
										<img class="img-circle img-responsive" src="<?php thumbGen($foto,80,80); ?>" alt="">
									</div>
									<div class="col-xs-8 col-sm-9 col-md-12 v-sm-9">
										<div class="contenido">
											<?php echo $description; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php } ?>
<?php wp_reset_postdata(); ?>
