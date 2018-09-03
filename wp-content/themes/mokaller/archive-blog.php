<?php get_header(); ?>	
<?php $idioma=$GLOBALS['idioma']; ?>
	<?php 
	$args=array(
		'pagename'=>'travel-insights',
		'post_type'=>'page',
		'post_parent'=>'0'
	); 

	$query=new WP_Query($args);
	
	while ( $query->have_posts() ) : $query->the_post();
	?>
	<div class="guia">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a class="primero" href="<?php echo get_option('home'); ?>/"><i class="fas fa-home"></i></a>
					<span xmlns:v="http://rdf.data-vocabulary.org/#"><span class="breadcrumb_last"><?php the_title(); ?></span></span></div>
				</div>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
	
	<section class="pagina">
		<div class="container">
			<div class="row">
				<?php 
				while ( $query->have_posts() ) : $query->the_post();
				?>
				<div class="col-md-12">
					<div class="titulo">
						<h1><?php the_title(); ?></h1>
					</div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				
				<?php 
				query_posts($query_string."&posts_per_page=-1&orderby=date&order=DESC");	
				if(have_posts()){ ?>
				<div class="col-md-12">
					<input id="gidioma" value="<?php echo $idioma; ?>" type="hidden" />
					<div class="listado">
						<div id="blogrid">
							<?php while ( have_posts() ) : the_post(); 
							$foto=get_the_post_thumbnail($post->ID,'full');
							$foto=extraerUrl($foto);
							if(is_array($foto)){$foto="";}
							?>
							<div class="media-box">
								<div class="modulo">
									<div class="imagen">
										<a href="<?php the_permalink(); ?>" class="rollover"></a>
										<img class="img-responsive" src="<?php thumbGen($foto,480,300); ?>" alt="<?php the_title(); ?>" />
									</div>
									<div class="contenido">
										<span class="fecha"><?php the_time('j'); echo " "; the_time('F'); echo ", "; the_time('Y'); ?></span>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<p><?php echo substr(strip_tags(get_the_content()),0,100)."..."; ?></p>
									</div>
									<div class="bajada clearfix">
										<a href="<?php the_permalink(); ?>">Artikel lesen</a>
									</div>
								</div>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php include("includes/howbook.php"); ?>
	<?php include("includes/contactus.php"); ?>
<?php get_footer(); ?>	