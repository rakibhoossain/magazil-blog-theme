<?php 
	$show_breaking_news			= get_theme_mod( 'magazil_show_breaking_news', true );





if ($show_breaking_news) {	


	$query 				= get_theme_mod( 'magazil_breaking_news_type', 'post' );

	// $cat 				= get_theme_mod( 'magazil_breaking_news_limit', 5 );
	$tag 				= get_theme_mod( 'magazil_breaking_news_tags', '' );
	$breaking_custom 	= '';
	// $breaking_custom 	= get_theme_mod( 'magazil_breaking_news_limit', 5 );

	$number 			= get_theme_mod( 'magazil_breaking_news_limit', 5 );

	$effect 			= get_theme_mod( 'magazil_breaking_news_effect', 'ticker' );
	$speed 				= get_theme_mod( 'magazil_breaking_news_speed', 750 );
	$timeout 			= get_theme_mod( 'magazil_breaking_news_timeout', 3500 );

?>


	
	<div class="clear"></div>
	<div id="breaking-news" class="breaking-news">
		<span class="breaking-news-title"><i class="fa fa-bolt"></i> <span><?php _e( 'Breaking News' , 'tie') ; ?></span></span>

		<?php
		if( $query != 'custom' ):
			if( $query == 'tag' ){
				$sep  = $fea_tags = '';
				$tags = explode (',' , $tag );
				foreach ($tags as $tag){
					$theTagId = get_term_by( 'name', $tag, 'post_tag' );
					if( !empty( $fea_tags ) ) $sep = ' , ';
					$fea_tags .=  $sep . $theTagId->slug;
				}
				$args = array('tag' => $fea_tags, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
			}else if($query == 'category'){
				// $args = array('category__in' => $cat, 'posts_per_page'=> $number, 'no_found_rows' => 1 );
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
			<?php if( is_array( $breaking_custom ) ){ ?>
			<ul>
				<?php foreach ($breaking_custom as $custom_text) {  ?>
				<li><a href="<?php echo $custom_text['link'] ?>" title="<?php echo $custom_text['text'] ?>"><?php echo $custom_text['text'] ?></a></li>				
			<?php } ?>
			</ul>
			<?php }	?>
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

<?php } ?>