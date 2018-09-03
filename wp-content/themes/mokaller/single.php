<?php get_header(); ?>	
	<?php include("includes/breadcrumb.php"); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();  
		$clave=$post->ID;
		
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";}
		
		$articles=get_field("related_articles");
		$tours=get_field("related_tours");
	?>
	<div class="slide">
		<div class="overlay"></div>
		<img class="img-responsive" src="<?php thumbGen($foto,1920,580); ?>" alt="<?php the_title(); ?>" />
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="contenido">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section id="pagina" class="pagina">
		<div class="container">
			<div class="parent">
				<div class="row">
					<div class="col-md-8">
						<div class="entrada">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="sidebar">
							<div id="sidebar">
								<?php include("includes/side_whybook.php"); ?>
								<?php include("includes/side_aviso.php"); ?>	
								<?php if($articles){ ?>
								<div class="grupo">
									<h2>Wussten Sie schon, …?</h2>
									<div class="relacionados">
										<?php 
										foreach($articles as $article){
										$foto="";
										$foto=get_the_post_thumbnail($article,'full');
										$foto=extraerUrl($foto);
										if(is_array($foto)){$foto="";}
										?>
										<div class="mod">
											<div class="row gutter">
												<div class="col-xs-4 col-sm-4 col-md-5">
													<div class="imagen">
														<a href="<?php echo get_the_permalink($article); ?>"><img class="img-responsive" src="<?php thumbGen($foto,480,350); ?>" alt="<?php echo get_the_title($article); ?>" /></a>
													</div>
												</div>
												<div class="col-xs-8 col-sm-8 col-md-7">
													<div class="contenido">
														<h3><a href="<?php echo get_the_permalink($article); ?>"><?php echo get_the_title($article); ?></a></h3>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php } ?>
								
								<?php if($tours) {?>
								<div class="grupo">
									<h2>Passende Reiseideen</h2>
									<div class="relacionados">
										<?php 
										foreach($tours as $tour){
										$foto="";
										$foto=get_the_post_thumbnail($tour,'full');
										$foto=extraerUrl($foto);
										if(is_array($foto)){$foto="";}
										?>
										<div class="mod">
											<div class="row gutter">
												<div class="col-xs-4 col-sm-4 col-md-5">
													<div class="imagen">
														<a href="<?php echo get_the_permalink($tour); ?>"><img class="img-responsive" src="<?php thumbGen($foto,480,350); ?>" alt="<?php echo get_the_title($tour); ?>" /></a>
													</div>
												</div>
												<div class="col-xs-8 col-sm-8 col-md-7">
													<div class="contenido">
														<h3><a href="<?php echo get_the_permalink($tour); ?>"><?php echo get_the_title($tour); ?></a></h3>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php } ?>
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