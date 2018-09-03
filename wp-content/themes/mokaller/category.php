<?php get_header(); ?>	
	<?php include("includes/breadcrumb.php"); ?>
	<section class="pagina">
		<div class="container">
			<div class="row">
				<?php 
				$args=array(
					'pagename'=>'travel-insights',
					'post_type'=>'page',
					'post_parent'=>'0'
				); 
			
				$query=new WP_Query($args);
				while ( $query->have_posts() ) : $query->the_post();
				?>
				<div class="col-md-12">
					<div class="titulo">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				
				<?php 
				query_posts($query_string."&posts_per_page=9&orderby=date&order=DESC");	
				if(have_posts()){ ?>
				<div class="col-md-12">
					<div id="listadoblog">
						<div class="listado">
							<div class="row">
								<?php while (have_posts()):the_post();
								$foto=get_the_post_thumbnail($post->ID,'full');
								$foto=extraerUrl($foto);
								if(is_array($foto)){$foto="";}
								?>
								<div class="col-sm-6 col-md-4">
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
					
					<div class="centrar">
						<?php 
						the_posts_pagination(array(
							'prev_text' =>'<span class="screen-reader-text">' . __( 'Previous page', 'mokaller' ) . '</span>',
							'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'mokaller' ) . '</span>',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'mokaller' ) . ' </span>',
						));
						?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php include("includes/howbook.php"); ?>
	<?php include("includes/contactus.php"); ?>
<?php get_footer(); ?>	