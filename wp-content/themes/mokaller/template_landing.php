<?php /*
Template name: Landing
*/
$status=varget("status","",20);
?>
<?php get_header(); ?>	
	<?php if (have_posts()) : while (have_posts()) : the_post(); 
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";} 
		
		$title=get_field("image_title");
		$subtitle=get_field("image_subtitle");
		$description=get_field("image_description");		
		$fdestination=get_field('destination');
		
		$titleb=get_field("title");
		$descriptionb=get_field("description");	
		
		$expert_title=get_field("expert_title");
		$fotoe=get_field('expert_image');
		if($fotoe){$fotoe=$fotoe['url'];}
		$expert_description=get_field("expert_description");
		
		$args=array(
			'pagename'=>'kontakt',
			'post_type'=>'page',
			'post_parent'=>'0'
		); 
		$query=new WP_Query($args);
		while ($query->have_posts()) : $query->the_post();
			$privacy=get_field("privacy");
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
		endwhile;
		wp_reset_postdata();
	?>
	<div class="contacto landing">
		<img class="img-responsive img" src="<?php thumbGen($foto,1920,700); ?>" alt="<?php the_title(); ?>" />
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
							'post_parent'=>'0'
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
									<?php include("includes/formularioc.php"); ?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php include("includes/whybook.php"); ?>
	<section class="pagina landing">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<div class="grupo">
								<h3><?php echo $expert_title; ?></h3>
								<div class="row">
									<div class="col-md-3">
										<img class="img-responsive" src="<?php thumbGen($fotoe,150,150); ?>" alt="<?php the_title(); ?>" />
									</div>
									<div class="col-md-9">
										<?php echo $expert_description; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="grupo ultimo">
								<h3><?php echo $titleb; ?></h3>
								<?php echo $descriptionb; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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
<?php get_footer(); ?>	