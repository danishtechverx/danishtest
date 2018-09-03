<?php /*
Template name: Contact us
*/

$status=varget("status","",20);
?>
<?php get_header(); ?>	
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		$ref=varcookie("ref","",20);
		if($ref){$tipo=get_post_type($ref);}
		
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";} 
		
		$title=get_field("image_title");
		$subtitle=get_field("image_subtitle");
		$description=get_field("image_description");
		$privacy=get_field("privacy");
		$fotob=get_field('image');
		if($fotob){$fotob=$fotob['url'];}	
		
		$fdestination=get_field('destination');
		$fname=get_field('name');
		$femail=get_field('email');
		$fphone=get_field('phone');
		$fnumber=get_field('number');
		$fmessage=get_field('message');
		$fcheckbox=get_field('checkbox');
		$fbutton=get_field('button');
		$fback=get_field('back_button');
		$fnext=get_field('next_button');
		$frequired=get_field('required_fields');
	?>
	<?php if($tipo=="tours"){ 
		$tourid=get_field("tour_id",$ref);
		$tourdmc=get_field("dmc",$ref);
		$tourn=get_the_title($ref);
		
		$price=get_field("price",$ref);
		$cities=get_field("visited",$ref);
		$duration=get_field("length_of_trip",$ref);		
	?>
	<div class="contacto <?php echo $tipo; ?>">
		<div style="display:none;" class="clearfix" id="alerta">
			<p id="errores"><?php echo $frequired; ?></p>
		</div>
		<img class="img-responsive movil" src="<?php thumbGen($fotob,1920,580); ?>" alt="<?php the_title(); ?>" />
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-11">
						<div class="contenido">
							<div class="row">
								<?php if($status=="success"){ ?>
								<div class="col-md-6 col-md-offset-3">
									<?php 
									$args=array(
										'pagename'=>'kontakt/vielen-dank',
										'post_type'=>'page',
									); 
									$query=new WP_Query($args);
									while ($query->have_posts()) : $query->the_post();
										$sub=get_field('subtitle');
									?>
									<div class="resultado">
										<h1><?php the_title(); ?></h1>
										<?php if($sub){ ?>
										<h2><?php echo $sub; ?></h2>
										<?php } ?>
										<?php the_content(); ?>
									</div>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								</div>
								<?php } else { ?>
								<div class="col-md-8">
									<?php if($title){ ?>
									<h1><?php echo $title; ?></h1>
									<?php } ?>
									<?php if($subtitle){ ?>
									<h2><?php echo $subtitle; ?></h2>
									<?php } ?>
									<div class="caracteristicas">
										<h3><?php echo $tourn; ?></h3>
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
								<div class="col-md-4">
									<?php include("includes/formulariob.php"); ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<img class="img-responsive desktop" src="<?php thumbGen($fotob,1920,580); ?>" alt="<?php the_title(); ?>" />
	</div>
	<?php } else { ?>
	<div class="contacto">
		<img class="img-responsive img" src="<?php thumbGen($foto,1920,900); ?>" alt="<?php the_title(); ?>" />
		<div style="display:none;" class="clearfix" id="alerta">
			<p id="errores"><?php echo $frequired; ?></p>
		</div>
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<?php if($status=="success"){ ?>
					<div class="col-md-6 col-md-offset-3">
						<?php 
						$args=array(
							'pagename'=>'kontakt/vielen-dank',
							'post_type'=>'page',
						); 
						$query=new WP_Query($args);
						while ($query->have_posts()) : $query->the_post();
							$sub=get_field('subtitle');
						?>
						<div class="resultado">
							<h1><?php the_title(); ?></h1>
							<?php if($sub){ ?>
							<h2><?php echo $sub; ?></h2>
							<?php } ?>
							<?php the_content(); ?>
						</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
					<?php } else { ?>
					<div class="col-md-8 col-md-offset-2">
						<div class="contenido">
							<div class="row">
								<div class="col-md-6">
									<?php if($title){ ?>
									<h1><?php echo $title; ?></h1>
									<?php } ?>
									<?php if($subtitle){ ?>
									<h2><?php echo $subtitle; ?></h2>
									<?php } ?>
									<?php if($description){ ?>
									<?php echo $description; ?>
									<?php } ?>
								</div>
								<div class="col-md-6">
									<?php include("includes/formularioa.php"); ?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<section class="pagina">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="nota">
						<div class="row gutter">
							<div class="col-xs-12 col-sm-3 col-md-2">
								<div class="icono img-circle">
									<i class="far fa-comment-alt"></i>
								</div>
							</div>
							<div class="col-xs-12 col-sm-10 col-md-10">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif; ?>
	<?php include("includes/whybook.php"); ?>
	<?php include("includes/promo.php"); ?>
<?php get_footer(); ?>	