<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
	$link=get_post_type_archive_link('tours');
	?>
	<div class="guia">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a class="primero" href="<?php echo get_option('home'); ?>/"><i class="fas fa-home"></i></a>
					<span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="<?php echo $link; ?>" rel="v:url" property="v:title">Reisen</a> | <span class="breadcrumb_last"><?php the_title(); ?></span></span></span>
				</div>
			</div>
		</div>
	</div>
	
	<?php 		$clave=$post->ID;
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";}
		
		$args=array(
			'pagename'=>'tour-sections',
			'post_type'=>'page',
			'post_parent'=>'0'
		); 
		$query=new WP_Query($args);
		while ( $query->have_posts() ) : $query->the_post();
			$map_title=get_field("map");
			$included_title=get_field("services");
			$highlights_title=get_field("highlights");
			$itinerary_title=get_field("itinerary");
		endwhile;
		wp_reset_postdata();				
		
		$subtitle=get_field("subtitle");
		$highlights=get_field("highlights");
		
		$map=get_field("map");
		$price=get_field("price");
		$cities=get_field("visited");
		$tagline=get_field("tagline");
		$included=get_field("included");
		$duration=get_field("length_of_trip");		
	?>
	<section class="pagina nopdb">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titulo">
						<h1><?php the_title(); ?> <?php if($subtitle){ ?><span><?php echo $subtitle; ?></span><?php } ?></h1>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="carrusel">
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<?php if($tagline){ ?>
						<div class="oferta"><span><?php echo $tagline; ?></span></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div id="carrusel">
			<div class="modulo">
				<img class="img-responsive" src="<?php thumbGen($foto,1920,580); ?>" alt="" />
			</div>
		</div>
	</div>
	<section id="pagina" class="pagina">
		<div class="container">
			<div class="parent">
				<div class="row">
					<div class="col-md-3 pull-right">
						<div class="sidebar">
							<div id="sidebar">
								<div class="modulo">
									<ul>
										<?php if($price){ ?>
										<li class="clearfix"><i class="fas fa-euro-sign"></i> <span><strong><?php echo $price; ?></strong></span></li>
										<?php } ?>
										<?php if($duration){ ?>
										<li class="clearfix"><i class="fas fa-calendar-alt"></i> <span><strong><?php echo $duration; ?></strong></span></li>
										<?php } ?>
										<?php if($cities){ ?>
										<li class="clearfix"><i class="fas fa-map-pin"></i><span><strong><?php echo $cities; ?></strong></span></li>
										<?php } ?>
									</ul>
									<?php include("includes/side_aviso_tour.php"); ?>
								</div>
								<?php include("includes/side_whybook.php"); ?>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="entrada">
							<?php the_content(); ?>
						</div>
						
						<?php if($highlights){ ?>
						<div class="desplegables">
							<div class="desplegador">
								<h2><?php echo $highlights_title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo">
									<?php echo $highlights; ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if($map){ ?>
						<div class="desplegables">
							<div class="desplegador">
								<h2><?php echo $map_title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo">
									<?php echo do_shortcode($map); ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php 
						if(have_rows('itinerary')){
						?>		
						<div class="desplegables">				
							<div class="desplegador">
								<h2><?php echo $itinerary_title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo">
									<div class="itinerario">
										<?php 
										 while (have_rows('itinerary')):the_row();
											$title=get_sub_field('title');	
											$foto=get_sub_field('image');
											if($foto){$foto=$foto['url'];}															
											$day=get_sub_field("day");
											$food=get_sub_field("meals");
											$hotel=get_sub_field("hotel");
											$room=get_sub_field("room");
											$description=get_sub_field("description");
										?>
										<div class="modulo">
											<div class="row">
												<div class="col-xs-12 col-sm-3 col-md-4">
													<?php if($day){ ?>
													<img class="esquina" src="<?php bloginfo('stylesheet_directory'); ?>/img/bg_titulo.png" alt="" />
													<div class="dia">
														<span><?php echo $day; ?></span>
													</div>
													<?php } ?>
													<div class="imagen">
														<img class="img-responsive" src="<?php thumbGen($foto,768,600); ?>" alt="" />
														<?php if($food){ ?>
														<div class="linea">
															<div class="row gutter">
																<div class="col-xs-1 col-sm-1 col-md-1">
																	<i class="fas fa-utensils"></i> 
																</div>
																<div class="col-xs-11 col-sm-11 col-md-10">
																	<span><?php echo $food; ?></span>
																</div>
															</div>
														</div>
														
														<?php } ?>
														<?php if($hotel){ ?>
														<div class="linea ultima">
															<div class="row gutter">
																<div class="col-xs-1 col-sm-1 col-md-1">
																	<i class="fas fa-h-square"></i>
																</div>
																<div class="col-xs-11 col-sm-11 col-md-10">
																	<span><?php echo $hotel ?><br /><?php echo $room; ?></span>
																</div>
															</div>
														</div>
														<?php } ?>
													</div>
												</div>
												<div class="col-xs-12 col-sm-9 col-md-8">
													<h3><?php echo $title; ?></h3>
													<div class="deslizable">
														<?php echo $description; ?>
													</div>
												</div>
											</div>
										</div>
										<?php endwhile; ?>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if($included){ ?>
						<div class="desplegables">
							<div class="desplegador">
								<h2><?php echo $included_title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo">
									<?php echo $included; ?>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif; ?>
	<?php include("includes/contactus.php"); ?>
<?php get_footer(); ?>