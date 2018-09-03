<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		$link=get_post_type_archive_link('destinations');
	?>
	<div class="guia">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a class="primero" href="<?php echo get_option('home'); ?>/"><i class="fas fa-home"></i></a>
					<span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="<?php echo $link; ?>" rel="v:url" property="v:title">Reiseziele</a> | <span class="breadcrumb_last"><?php the_title(); ?></span></span></span>
				</div>
			</div>
		</div>
	</div>
	<?php 		
		$clave=$post->ID;
		$miSlug=get_field("country");
		$slug=crearSlug($miSlug);
		
		
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";}
	
		$subtitle=get_field("subtitle");
		$tours_title=get_field("tours_title");
		$tours=get_field('tours');
		$map_title=get_field("map_title");
		$map=get_field("map_shortcode");
		$regions_title=get_field("regions_title");
		$regions_description=get_field("regions_description");
		$regions=get_field("regions");
		$blog_title=get_field("blog_title");
		$blogs=get_field('posts');
		$when_title=get_field("w_title");
		$when_description=get_field("w_description");
		$months=get_field("months");
	?>
	<div class="slide">
		<div class="overlay"></div>
		<img class="img-responsive" src="<?php thumbGen($foto,1920,580); ?>" alt="<?php the_title(); ?>" />
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="contenido">
							<h1><?php the_title(); ?> <?php if($subtitle){ ?><span><?php echo $subtitle; ?></span><?php } ?></h1>							
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
					<div class="col-md-9">
						<div class="entrada">
							<?php the_content(); ?>
						</div>
						
						<?php if($when_title){ 
							$postname=crearSlug($when_title);
						?>
						<div class="desplegables" id="<?php echo $postname; ?>">
							<div class="desplegador">
								<h2><?php echo $when_title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo">
									<?php echo $when_description; ?>
									<?php if($months){ ?>
									<div class="meses">
										<div class="row gutter">
											<?php 
											$array=$months;
											$options=ul_to_array($array);
											if($options){
											foreach($options as $opt){
												$linea=explode(":",$opt);
											?>
											<div class="col-xs-4 col-sm-2 col-md-2">
												<div class="mes m_<?php echo $linea[1]; ?>">
													<span><?php echo $linea[0]; ?></span>
												</div>
											</div>
											<?php } ?>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php 
						if($tours){ 
							$postname=crearSlug($tours_title);
						?>
						<div id="<?php echo $postname; ?>">
							<div id="accordiontours">
								<div class="desplegador">
									<h2><?php echo $tours_title; ?></h2>
								</div>
								<div class="desplegable">
									<div class="grupo">
										<div id="listadotours">
											<div class="listado">
												<div class="row">
													<?php foreach($tours as $tour){
														$foto="";
														$foto=get_the_post_thumbnail($tour,'full');
														$foto=extraerUrl($foto);
														if(is_array($foto)){$foto="";}
														
														$price=get_field("price",$tour);
														$cities=get_field("visited",$tour);
														$tagline=get_field("tagline",$tour);
														$duration=get_field('length_of_trip',$tour);										
														$extracto=get_field("short_overview",$tour);
													?>
													<div class="col-sm-6 col-md-4">
														<div class="modulo">
															<?php if($tagline){ ?>
															<div class="oferta"><span><?php echo $tagline; ?></span></div>
															<?php } ?>
															<div class="imagen">
																<a href="<?php echo get_the_permalink($tour); ?>" class="rollover"></a>
																<img class="img-responsive" src="<?php thumbGen($foto,768,380); ?>" alt="" />
															</div>
															<div class="contenido">
																<h3><a href="<?php echo get_the_permalink($tour); ?>"><?php echo get_the_title($tour); ?></a></h3>
																<p><?php echo $extracto; ?></p>
																<div class="caracteristicas">
																	<?php if($price){ ?>
																	<span><i class="fas fa-euro-sign"></i> <?php echo $price; ?></span>
																	<?php } ?>
																	<?php if($duration){ ?>
																	<span><i class="fas fa-calendar-alt"></i> <?php echo $duration; ?></span>
																	<?php } ?>
																	<?php if($cities){ ?>
																	<span><i class="fas fa-map-pin"></i> <?php echo $cities; ?></span>
																	<?php } ?>
																</div>
															</div>
														</div>
													</div>
													<?php } ?>
												</div>
											</div>
										</div>
										<div class="clearfix">
											<a class="todos" href="<?php echo get_option('home'); ?>/reisen-liste/reiseziel/<?php echo $slug; ?>/">Mehr Reisen ansehen</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if($map){ 
							$postname=crearSlug($map_title);
						?>
						<div class="desplegables" id="<?php echo $postname; ?>">
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
					
						<?php if($regions){
							$postname=crearSlug($regions_title);	
						?>
						<div class="desplegables" id="<?php echo $postname; ?>">
							<div class="desplegador">
								<h2><?php echo $regions_title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo especial">
									<?php echo $regions_description; ?>
									<div class="destinos">
										<div class="row">
											<?php foreach($regions as $region){
												$foto="";
												$foto=get_the_post_thumbnail($region,'full');
												$foto=extraerUrl($foto);
												if(is_array($foto)){$foto="";}
											?>
											<div class="col-xs-12 col-sm-6 col-md-4">
												<a href="<?php echo get_the_permalink($region); ?>" class="modulo">
													<div class="imagen">
														<div class="rollover"></div>
														<img class="img-responsive" src="<?php thumbGen($foto,768,350); ?>" alt="<?php echo get_the_title($region); ?>">
													</div>
													<span><?php echo get_the_title($region); ?></span>
												</a>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php 
						if(have_rows('element')){
							 while (have_rows('element')):the_row();
								$title=get_sub_field('title');	
								$description=get_sub_field("description");
								$postname=crearSlug($title);
						?>
						<div class="desplegables" id="<?php echo $postname; ?>">
							<div class="desplegador">
								<h2><?php echo $title; ?></h2>
							</div>
							<div class="desplegable">
								<div class="grupo">
									<div class="clearfix">
										<?php echo $description; ?>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
						<?php } ?>
							
						<?php 
						if($blogs){ 
							$postname=crearSlug($blog_title);
						?>
						<div class="desplegables" id="<?php echo $postname; ?>">
							<div class="desplegador">
								<h2><?php echo $blog_title; ?></h2>
							</div>
							<div id="accordionblog">
								<div class="grupo">
									<div id="listadoblog">
										<div class="listado">
											<div class="row">
												<?php 												
												foreach($blogs as $data){
													$foto="";
													$foto=get_the_post_thumbnail($data,'full');
													$foto=extraerUrl($foto);
													if(is_array($foto)){$foto="";} 
													$contenido=get_post($data);
												?>
												<div class="col-sm-6 col-md-4">
													<div class="modulo">
														<div class="imagen">
															<a href="<?php echo get_the_permalink($data); ?>" class="rollover"></a>
															<img class="img-responsive" src="<?php thumbGen($foto,768,400); ?>" alt="" />
														</div>
														<div class="contenido">
															<h3><a href="<?php echo get_the_permalink($data); ?>"><?php echo $contenido->post_title; ?></a></h3>
															<p><?php echo substr(strip_tags($contenido->post_content),0,100)."..."; ?></p>
														</div>
													</div>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-3">
						<div class="sidebar">
							<div id="sidebar">
								<?php include("includes/side_whybook.php"); ?>	
								<?php include("includes/side_aviso_destino.php"); ?>		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif; ?>
	<?php include("includes/whybook.php"); ?>
<?php get_footer(); ?>