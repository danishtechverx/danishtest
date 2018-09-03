<?php get_header(); ?>	
<?php 
$idioma=$GLOBALS['idioma'];
?>
	<div class="guia">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a class="primero" href="<?php echo get_option('home'); ?>/"><i class="fas fa-home"></i></a>
					<span xmlns:v="http://rdf.data-vocabulary.org/#"><span class="breadcrumb_last">Reisen</span></span>			
				</div>
			</div>
		</div>
	</div>
	<section class="pagina">
		<div class="container">
			<div class="parent">
				<div class="row">
					<div class="col-md-9">
						<div class="titulo">
							<h1>Reisen</h1>
						</div>
						<?php 
						query_posts($query_string."&posts_per_page=-1&orderby=date&order=DESC");	
						if(have_posts()){ ?>
						<input id="gidioma" value="<?php echo $idioma; ?>" type="hidden" />
						<div class="listado tours">
							<div id="tourgrid">
								<?php while (have_posts()):the_post();
									$foto=get_the_post_thumbnail($post->ID,'full');
									$foto=extraerUrl($foto);
									if(is_array($foto)){$foto="";}
									$price=get_field("price");
									$cities=get_field("visited");
									$tagline=get_field("tagline");
									$extracto=get_field("short_overview");
									$duration=get_field("length_of_trip");
								?>
								<div class="media-box">
									<div class="grupo">
										<div class="modulo">
											<?php if($tagline){ ?>
											<div class="oferta"><span><?php echo $tagline; ?></span></div>
											<?php } ?>
											<div class="imagen">
												<a href="<?php the_permalink(); ?>" class="rollover"></a>
												<img class="img-responsive" src="<?php thumbGen($foto,768,380); ?>" alt="" />
											</div>
											<div class="contenido">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
								</div>
								<?php endwhile; ?>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-3">
						<div class="sidebar">
							<div id="sidebar">
								<?php include("includes/side_whybook.php"); ?>
								<?php include("includes/side_aviso_tour.php"); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include("includes/howbook.php"); ?>
	<?php include("includes/categories.php"); ?>
	<?php include("includes/contactus.php"); ?>
<?php get_footer(); ?>	