<?php 
	$show_breaking_news			= get_theme_mod( 'magazil_show_breaking_news', true );
if ($show_breaking_news) {	


	$query 				= get_theme_mod( 'magazil_breaking_news_type', 'post' );
	$page 				= get_theme_mod( 'magazil_breaking_news_page', 0 );
	$cat 				= get_theme_mod( 'magazil_breaking_news_category', 0 );
	$tags 				= get_theme_mod( 'magazil_breaking_news_tags', '' );
	$breaking_custom 	= get_theme_mod( 'magazil_breaking_news_custom');

	$number 			= get_theme_mod( 'magazil_breaking_news_limit', 5 );

	$effect 			= get_theme_mod( 'magazil_breaking_news_effect', 'ticker' );
	$speed 				= get_theme_mod( 'magazil_breaking_news_speed', 750 );
	$timeout 			= get_theme_mod( 'magazil_breaking_news_timeout', 3500 );

?>


	
	<div class="clear"></div>
	<div id="breaking-news" class="breaking-news">
		<span class="breaking-news-title"><i class="fa fa-bolt"></i> <span><?php _e( 'Breaking News' , 'magazil') ; ?></span></span>

		<?php
		if( $query != 'custom' ):
			if( $query == 'page' ){
				$args = array('post_type' => 'page', 'post__in' => $page, 'no_found_rows' => 1 );
			}else if( $query == 'tag' ){
				$args = array('tag__in' => $tags, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}else if($query == 'category'){
				$args = array('category__in' => $cat, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}else{
				$args = array('post_type' => 'post', 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}

			$breaking_query = new wp_query( $args  );
			
			if( $breaking_query->have_posts() ) : ?>
			<ul>
		<?php
		while( $breaking_query->have_posts() ) :
			$breaking_query->the_post();
		?>
			<li><a href="<?php the_permalink()?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
		<?php
			endwhile;
			wp_reset_postdata();
			wp_reset_query();
		?>
			</ul>
			<?php endif; ?>
		
		<?php else: ?>
			<?php if( !empty($breaking_custom) ){ ?>
			<ul>
				<?php echo wp_specialchars_decode($breaking_custom);  ?>	
			</ul>
			<?php }	?>
		<?php endif; ?>

		


		<script type="text/javascript">
			jQuery(document).ready(function(){
				<?php if( $effect == 'ticker' ): ?>
				createTicker(); 
				<?php else: ?>
				jQuery('#breaking-news ul').innerFade({animationType: '<?php echo esc_attr($effect)  ?>', speed: <?php echo esc_attr($speed) ?> , timeout: <?php echo esc_attr($timeout) ?>});
				<?php endif; ?>
			});
			<?php if( $effect == 'ticker' ): ?>                                                 
			function rotateTicker(){                                   
				if( i == tickerItems.length ){ i = 0; }                                                         
				tickerText = tickerItems[i];                              
				c = 0;                                                    
				typetext();                                               
				setTimeout( "rotateTicker()", <?php echo esc_attr($timeout) ?> );                     
				i++;                                                      
			}                                                           
			<?php endif; ?>
		</script>

	</div> <!-- .breaking-news -->

<?php } ?>