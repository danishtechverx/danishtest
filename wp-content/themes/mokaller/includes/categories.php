<section class="par">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titulo">
						<h2>Weitere Suchergebnisse</h2>
					</div>
				</div>
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<?															
						$terms=get_terms(array(
							'taxonomy'=>'reisen-liste',
							'hide_empty'=>false,
							'parent'=>0
						));
						?>
						<?php 
						$count=0;
						foreach($terms as $term){ 
							$count++;
							$hijos=get_terms(array(
								'taxonomy'=>'reisen-liste',
								'hide_empty'=>false,
								'parent'=>$term->term_id,
							));
							
							if($count==5){
								echo "</div><div class='row'>";
								$count=1;
							}
						?>
						<?php if($term->name){ ?>
						<div class="col-md-3">
							<h3><?php echo $term->name; ?></h3>
							<?php if($hijos){ ?>
							<ul class="widget">
								<?php foreach($hijos as $hijo){  
									if($hijo->parent==$filtro){$adicional="";}
									else{if($clave){$adicional="?d=".$clave;}else{if($key){$adicional="?d=".$key;}}}
								if($hijo->name){
								?>
								<li><a href="<?php echo get_term_link($hijo->term_id).$adicional; ?>"><?php echo $hijo->name; ?></a></li>
								<?php } ?>
								<?php } ?>
							</ul>
							<?php } ?>
						</div>
						<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>