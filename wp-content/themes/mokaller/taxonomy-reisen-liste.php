<?php get_header(); ?>	
<?php 
$clave=varget("d","",100);
if ($dato=get_page_by_path($clave, OBJECT, 'reiseziele')){$buscar=$dato->ID;}
else{$buscar=0;}

if($buscar){
	$titulo=get_the_title($buscar);
}
?>
	<?php include("includes/breadcrumb.php"); ?>
	<section class="pagina">
		<div class="container">
			<div class="parent">
				<div class="row">
					<div class="col-md-9">
						<div class="titulo">
							<?php 
							$queried_object=get_queried_object();
							$padre=$queried_object->parent;
							$key="";
							
							$filtro=get_term_by('slug','reiseland','reisen-liste');
							$filtro=$filtro->term_id;
							
							if($padre==$filtro){$key=$queried_object->slug;}
							
							if($padre){
								$parent=get_term_by('id',$padre,'reisen-liste');
							}
							if($parent){
								$subtitle=get_field("subtitle","reisen-liste_".$padre);
							?>
							<?php if($clave and $dato){ ?>
							<h1><?php echo $titulo; ?></h1>
							<?php } else { ?>
							<h1><?php echo $parent->name; ?></h1>
							<?php } ?>
							<h2><?php echo $queried_object->name; ?></h2>
							<?php } ?>
						</div>
						<?php 
						if(!$clave){query_posts($query_string."&posts_per_page=-1&orderby=date&order=DESC");}
						else{
							$temp=array();
							$datos=explode("=",$query_string);
							$datos=$datos[1];
							$datos=explode("%2F",$datos);
							unset($datos[0]);							
							foreach($datos as $data){array_push($temp,$data);}
							
							$paged=(get_query_var('paged'))?get_query_var('paged'):1;
							$args=array(
								"posts_per_page"=>-1,
								"post_type"=>'reisen',
								"orderby"=>"date",
								"order"=>"DESC",
								'paged'=>$paged,
								'meta_query' => array(
									array(
										'key' => 'countries',
										'value' => '"'.$buscar.'"',
										'compare' => 'LIKE'
									)
								),
								'tax_query'=>array(
									array(
										'taxonomy'=>'reisen-liste',
										'field'=>'slug',
										'terms'=>$temp,
									)
								),
							);
														
							query_posts($args);	
						}
						
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
									$duration=get_field('length_of_trip');										
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