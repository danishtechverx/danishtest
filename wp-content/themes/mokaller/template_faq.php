<?php /*
Template name: FAQ's
*/
?>
<?php get_header(); ?>	
	<?php include("includes/breadcrumb.php"); ?>
	<?php 
	if (have_posts()) : while (have_posts()) : the_post();  
		$foto="";
		$foto=get_the_post_thumbnail($post->ID,'full');
		$foto=extraerUrl($foto);
		if(is_array($foto)){$foto="";}
	?>
	<div class="slide">
		<div class="overlay"></div>
		<img class="img-responsive" src="<?php thumbGen($foto,1920,580); ?>" alt="<?php the_title(); ?>" />
		<div class="leyenda">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
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
					<div class="col-md-9">
						<?php 
						$query=new WP_Query(array('post_type'=>'faqs','orderby'=>'menu_order','order'=>'DESC','posts_per_page'=>-1));
						if($query->have_posts()){
						?>
						<div class="tabbable tabs-left">
							<ul class="nav nav-tabs">
								<?php 
								$count=0;
								while ($query->have_posts()):$query->the_post(); 
									$count++;
									if($count==1){$active="class='active'";}else{$active="";}
								?>
								<li <?php echo $active; ?>><a href="#<?php echo $post->post_name; ?>" data-toggle="tab"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
							<div class="tab-content">
								<?php 
								$count=0;
								while ($query->have_posts()):$query->the_post(); 
									$count++;
									if($count==1){$active="active";}else{$active="";}
								?>
								<div class="tab-pane <?php echo $active; ?>" id="<?php echo $post->post_name; ?>">                
									<div class="">
										<?php the_content(); ?>
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