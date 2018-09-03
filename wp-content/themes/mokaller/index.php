<?php get_header(); ?>

	<?php 	$query=new WP_Query(array('post_type'=>'slide','orderby'=>'menu_order','order'=>'DESC','posts_per_page'=>-1));
	if($query->have_posts()){
	?>
	<div class="carrusel cS-hidden">			
		<div id="carrusel">
			<?php while ($query->have_posts()):$query->the_post(); 
			$foto=get_the_post_thumbnail($post->ID,'full');
			$foto=extraerUrl($foto);
			if(is_array($foto)){$foto="";}
			$boton=get_field("button_text");
			$url=get_field("link");
			
			$imagen=get_field('mobile_image');
			if($imagen){$imagen=$imagen['url'];}	
			?>
			<div class="modulo">
				<img class="img-responsive desktop" src="<?php thumbGen($foto,1920,650); ?>" alt="" />
				<img class="img-responsive movil" src="<?php thumbGen($imagen,1536,1480); ?>" alt="" />
				<div class="leyenda">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-8">
								<div class="contenido">
									<h2><?php the_title(); ?></h2>
									<?php the_content(); ?>
									<?php if($url and $boton){ ?>
									<div class="clearfix">
										<a href="<?php echo $url; ?>" class="boton"><span><?php echo $boton; ?></span></a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<div class="flechas">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="clearfix">
							<a id="avanzar1" class="adelante" href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/avanzar.png" alt="avanzar" /></a>
							<a id="retroceder1" class="atras" href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/retroceder.png" alt="retroceder" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>
	<?php wp_reset_postdata(); ?>

	<?php 	$query=new WP_Query(array('post_type'=>'slide','orderby'=>'menu_order','order'=>'DESC','posts_per_page'=>1));
	if($query->have_posts()){
	?>	
	<div class="carrusel sinjs">
		<noscript>
			<?php while ($query->have_posts()):$query->the_post(); 
			$foto=get_the_post_thumbnail($post->ID,'full');
			$foto=extraerUrl($foto);
			if(is_array($foto)){$foto="";}
			$boton=get_field("button_text");
			$url=get_field("link");
			
			$imagen=get_field('mobile_image');
			if($imagen){$imagen=$imagen['url'];}	
			?>
			<img class="img-responsive desktop" src="<?php thumbGen($foto,1920,650); ?>" alt="" />
			<img class="img-responsive movil" src="<?php thumbGen($imagen,1536,1480); ?>" alt="" />
			<div class="leyenda">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8">
							<div class="contenido">
								<h2><?php the_title(); ?></h2>
								<?php the_content(); ?>
								<?php if($url and $boton){ ?>
								<div class="clearfix">
									<a href="<?php echo $url; ?>" class="boton"><span><?php echo $boton; ?></span></a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</noscript>
	</div>
	<?php } ?>
	<?php wp_reset_postdata(); ?>
	
	
	<?php include("includes/howbook.php"); ?>
	
	<?php 
	$args=array(
		'p'=>'756',
		'post_type'=>'page',
		'post_parent'=>'0'
	); 
	$query=new WP_Query($args);
	while ($query->have_posts()) : $query->the_post();
		$destination=get_field("destination");
		$destinations=get_field("destinations");
		
		$tour_title=get_field("tour");
		$tour_description=get_field("tour_description");
		$tour_button=get_field("tour_button");
		$tours=get_field("tour_posts");
		
		$blog=get_field("blog");
		$blogs=get_field("blog_posts");
		$blog_button=get_field("blog_button");
	?>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	
	<?php if($destination and $destinations){ ?>
	<section class="par">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titulo">
						<h2><?php echo $destination; ?></h2>
					</div>
				</div>
				<div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-12 col-md-offset-0">
					<div class="destinos">
						<div class="row">
							<?php foreach($destinations as $destino){
								$foto="";
								$foto=get_the_post_thumbnail($destino,'full');
								$foto=extraerUrl($foto);
								if(is_array($foto)){$foto="";}
								$titulo=get_field("country",$destino);
							?>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<div class="modulo">
									<a href="<?php echo get_the_permalink($destino); ?>">
										<div class="imagen">
											<div class="rollover"></div>
											<img class="img-responsive" src="<?php thumbGen($foto,480,300); ?>" alt="<?php echo $titulo; ?>">
										</div>
										<span><?php echo $titulo; ?></span>
									</a>
								</div>
							</div>
							<?php } ?>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
		
	<?php if($tour_title and $tours){ ?>
	<section class="bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titulo">
						<h2><?php echo $tour_title; ?></h2>
					</div>
				</div>
				<div class="col-md-9">
					<?php if($tour_description){ ?>
					<div class="descripcion">
						<?php echo "<p>".$tour_description."</p>"; ?>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-3">
					<?php if($tour_button){ ?>
					<div class="clearfix">
						<a href="<?php echo get_post_type_archive_link("tours"); ?>" class="boton"><span><?php echo $tour_button; ?></span></a>
					</div>
					<?php } ?>
				</div>
				<div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-12 col-md-offset-0">
					<div id="listadotours">
						<div class="listado tours">
							<div class="row">
								<?php foreach($tours as $tour){ 
									$foto="";
									$foto=get_the_post_thumbnail($tour,'full');
									$foto=extraerUrl($foto);
									if(is_array($foto)){$foto="";}
									
									$extracto=get_field("short_overview",$tour);
									$price=get_field("price",$tour);
									$cities=get_field("visited",$tour);
									$duration=get_field("length_of_trip",$tour);
								?>
								<div class="col-md-4">
									<div class="modulo">
										<div class="imagen">
											<a href="<?php echo get_the_permalink($tour); ?>" class="rollover"></a>
											<img class="img-responsive" src="<?php thumbGen($foto,480,300); ?>" alt="" />
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
												<span><i class="fas fa-map-pin"></i><?php echo $cities; ?></span>
												<?php } ?>
											</div>
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
	</section>
	<?php } ?>	
	
	<?php 
	if($blog and $blogs){
	?>
	<section class="par">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titulo">
						<h2><?php echo $blog; ?></h2>
					</div>
				</div>
				<div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2 col-md-12 col-md-offset-0">
					<div id="listadoblog">
						<div class="listado blog">
							<div class="row">
								<?php 
								$count=0;
								foreach($blogs as $entrada){
									$count++;
									$foto="";
									$foto=get_the_post_thumbnail($entrada,'full');
									$foto=extraerUrl($foto);
									if(is_array($foto)){$foto="";}
									
									if($count==1){$clase="primero";}else{$clase="";}
																		
								?>
								<div class="col-md-4">
									<div class="modulo <?php echo $clase; ?>">
										<div class="imagen">
											<a href="<?php echo get_the_permalink($entrada); ?>" class="rollover"></a>
											<img class="img-responsive" src="<?php thumbGen($foto,480,300); ?>" alt="" />
										</div>
										<div class="contenido">
											<span class="fecha"><?php echo get_the_time('j',$entrada); echo " "; echo get_the_time('F',$entrada); echo ", "; echo get_the_time('Y',$entrada); ?></span>
											<h3><a href="<?php echo get_the_permalink($entrada); ?>"><?php  echo get_the_title($entrada); ?></a></h3>
											<?php echo get_the_content($entrada); ?>
											<p><?php echo substr(strip_tags($entrada->post_content),0,200)."..."; ?></p>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php if($blog_button){ ?>
					<div class="utilitario clearfix">
						<?php $blogid=get_post_type_archive_link("magazin"); ?>
						<a href="<?php echo $blogid; ?>" class="boton inverso"><span><?php echo $blog_button; ?></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
	
	<?php include("includes/whybook.php"); ?>
	<?php include("includes/promo.php"); ?>
<?php get_footer(); ?>	