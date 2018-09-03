<div class="modulo ultimo">
	<?php 
	$args=array(
		'pagename'=>'sidebar',
		'post_type'=>'page',
		'post_parent'=>'0'
	); 
	$query=new WP_Query($args);
	
	if($query->have_posts()){ ?>
	<?php while ($query->have_posts()) : $query->the_post(); ?>
	<p class="title"><?php the_title(); ?></h2>
	<?php if(have_rows('element')){?>
	<ul>
		<?php  
		while (have_rows('element')):the_row();
			$foto=get_sub_field('icon');
			if($foto){$foto=$foto['url'];}	
			$description=get_sub_field("description");
		?>
		<li class="clearfix"><img class="img-responsive" src="<?php thumbGen($foto,30,30); ?>" alt=""> <p><?php echo $description; ?></p></li>
		<?php endwhile; ?>
	</ul>
	<?php } ?>
	<?php endwhile; ?>
	<?php } ?>
	<?php wp_reset_postdata(); ?>
</div>