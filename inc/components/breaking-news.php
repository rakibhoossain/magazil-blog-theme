<?php 



	// $number========'' 			= tie_get_option('breaking_number');
	// $effect 		ticker	fade= tie_get_option('breaking_effect');
	// $speed 				= tie_get_option('breaking_speed' );
	// $timeout 			= tie_get_option('breaking_time'  );
$effect = 'ticker';$number = 5;$speed = 750;$timeout = 3500;
	if( !$number || $number == ' ' || !is_numeric($number) ) $number = 5;
	if( !$effect )	$effect = 'ticker';
	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 750 ;
	if( !$timeout || $timeout == ' ' || !is_numeric($timeout))	$timeout = 3500; 

	?>
	
	<div class="clear"></div>
	<div id="breaking-news" class="breaking-news">
		<span class="breaking-news-title"><i class="fa fa-bolt"></i> <span><?php _e( 'Breaking News' , 'tie') ; ?></span></span>
<?php 
$args = new WP_Query( array(
							'post_type' => 'post',//'page ,post',
							'order' => 'DESC',
						) );
			$breaking_query = new wp_query( $args  );
			
			if( $breaking_query->have_posts() ) : $count=0; ?>
			<ul>
		<?php
		while( $breaking_query->have_posts() ) :
			$breaking_query->the_post();
			$count++;
		?>
			<li><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
		<?php
			endwhile;
			wp_reset_query();
		?>
			</ul>
			<?php endif; ?>

		


		<script type="text/javascript">
			jQuery(document).ready(function(){
				<?php if( $effect == 'ticker' ): ?>
				createTicker(); 
				<?php else: ?>
				jQuery('#breaking-news ul').innerFade({animationType: '<?php echo $effect ?>', speed: <?php echo $speed ?> , timeout: <?php echo $timeout ?>});
				<?php endif; ?>
			});
			<?php if( $effect == 'ticker' ): ?>                                                 
			function rotateTicker(){                                   
				if( i == tickerItems.length ){ i = 0; }                                                         
				tickerText = tickerItems[i];                              
				c = 0;                                                    
				typetext();                                               
				setTimeout( "rotateTicker()", <?php echo $timeout ?> );                     
				i++;                                                      
			}                                                           
			<?php endif; ?>
		</script>

	</div> <!-- .breaking-news -->
