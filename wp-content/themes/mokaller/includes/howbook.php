<?php 
$args=array(
	'pagename'=>'how-book-on-mokaller',
	'post_type'=>'page',
	'post_parent'=>'0'
); 
$query=new WP_Query($args);

if($query->have_posts()){ 
?>
<section class="nopdt">
	<div class="container">
		<?php while ($query->have_posts()) : $query->the_post(); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="titulo">
					<h2><?php the_title(); ?></h2>
				</div>
			</div>
			<div class="col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1">
				<?php if(have_rows('element')){?>
				<div class="iconos">
					<div class="row">
						<?php  while (have_rows('element')):the_row();
							$foto=get_sub_field('icon');
							if($foto){$foto=$foto['url'];}	
							$title=get_sub_field("title");
							$description=get_sub_field("description");
						?>
						<div class="col-md-4">
							<div class="modulo">
								<div class="row">
									<div class="col-xs-3 col-sm-3 col-md-12">
										<img class="img-circle img-responsive" src="<?php thumbGen($foto,80,80); ?>" alt="<?php echo $title; ?>">
									</div>
									<div class="col-xs-9 col-sm-9 col-md-12">
										<h3><?php echo $title; ?></h3>
										<p><?php echo $description; ?></p>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
</section>
<?php } ?>