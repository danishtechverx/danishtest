<?php /*
Template name: About us
*/
?>
<?php get_header(); ?>	
	<?php include("includes/breadcrumb.php"); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";} 
		
		$subtitle=get_field("subtitle");
		$phone=get_field("phone");
		$email=get_field("email");
		$map=get_field("map");
		$icon=get_field("icon");
		if($icon){$icon=$icon['url'];}	
			
	?>
	<div class="slide">
		<div class="overlay"></div>
		<img class="img-responsive" src="<?php thumbGen($foto,1920,580); ?>" alt="<?php the_title(); ?>" />
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-md-offset-3">
						<div class="contenido">
							<h1><?php the_title(); ?></h1>
							<?php if($subtitle){ ?>
							<p><?php echo $subtitle; ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="pagina">
		<div class="container">
			<div class="row">
				<div class="col-md-9 pull-right">
					<div class="entrada">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="sidebar">
						<div class="modulo">
							<div class="contactos">
								<div class="row">
									<div class="col-sm-6 col-md-12">
										<?php if($icon){ ?>
										<img class="img-responsive" src="<?php echo $icon; ?>" alt="Mokaller" />
										<?php } ?>
									</div>
									<div class="col-sm-6 col-md-12">
										<?php if($map){ ?>
										<div class="mapa">
											<?php echo do_shortcode($map); ?>
										</div>
										<?php } ?>
										<h4>Kontakt</h4>
										<?php if($email){ ?>
										<p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
										<?php } ?>
										<?php if($phone){ ?>
										<p><?php echo $phone; ?></p>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif; ?>
	<?php include("includes/contactus.php"); ?>
<?php get_footer(); ?>	