    <?php
      $theParent = wp_get_post_parent_id(get_the_ID());
      if ($theParent) { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
      <?php }
    ?>

    
    
    <?php 
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $testArray) { ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
      <ul class="min-list">
        <?php
          if ($theParent) {
            $findChildrenOf = $theParent;
          } else {
            $findChildrenOf = get_the_ID();
          }

          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          ));
        ?>
      </ul>
    </div>
    <?php } ?>





<?php

$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );


$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : ?>

    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

        <div id="parent-<?php the_ID(); ?>" class="parent-page">

            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

            <p><?php the_advanced_excerpt(); ?></p>

        </div>

    <?php endwhile; ?>

<?php endif; wp_reset_postdata(); ?>    
explode("\n", $your_string_from_db);

fa fa-500px
fa fa-amazon  
fa fa-adn 
fa fa-android 
fa fa-angellist 
fa fa-apple 
fa fa-bandcamp  
fa fa-behance 
fa fa-behance-square  
fa fa-bitbucket 
fa fa-bitbucket-square  
fa fa-bitcoin 
fa fa-black-tie 
fa fa-bluetooth 
fa fa-bluetooth-b 
fa fa-btc 
fa fa-buysellads  
fa fa-cc-amex 
fa fa-cc-diners-club  
fa fa-cc-mastercard 
fa fa-cc-paypal 
fa fa-cc-stripe 
fa fa-cc-visa 
fa fa-chrome  
fa fa-codepen 
fa fa-codiepie  
fa fa-connectdevelop  
fa fa-contao  
fa fa-css3  
fa fa-dashcube  
fa fa-delicious 
fa fa-deviantart  
fa fa-digg  
fa fa-dribbble  
fa fa-dropbox 
fa fa-drupal  
fa fa-edge  
fa fa-eercast 
fa fa-empire  
fa fa-envira  
fa fa-etsy  
fa fa-expeditedssl  
fa fa-fa  
fa fa-facebook  
fa fa-facebook-f  
fa fa-facebook-official 
fa fa-facebook-square 
fa fa-firefox 
fa fa-first-order 
fa fa-flickr  
fa fa-fonticons 
fa fa-font-awesome  
fa fa-fort-awesome  
fa fa-forumbee  
fa fa-foursquare  
fa fa-free-code-camp  
fa fa-ge  
fa fa-get-pocket  
fa fa-gg  
fa fa-gg-circle 
fa fa-git 
fa fa-git-square  
fa fa-github  
fa fa-github-alt  
fa fa-github-square 
fa fa-gitlab  
fa fa-gittip  
fa fa-glide 
fa fa-glide-g 
fa fa-google  
fa fa-google-plus 
fa fa-google-plus-circle  
fa fa-google-plus-official  
fa fa-google-plus-square  
fa fa-google-wallet 
fa fa-gratipay  
fa fa-grav  
fa fa-hacker-news 
fa fa-houzz 
fa fa-html5 
fa fa-imdb  
fa fa-instagram 
fa fa-internet-explorer 
fa fa-ioxhost 
fa fa-joomla  
fa fa-jsfiddle  
fa fa-lastfm  
fa fa-lastfm-square 
fa fa-leanpub 
fa fa-linkedin  
fa fa-linkedin-square 
fa fa-linode  
fa fa-linux 
fa fa-maxcdn  
fa fa-meanpath  
fa fa-medium  
fa fa-meetup  
fa fa-mixcloud  
fa fa-modx  
fa fa-odnoklassniki 
fa fa-odnoklassniki-square  
fa fa-opencart  
fa fa-openid  
fa fa-opera 
fa fa-optin-monster 
fa fa-pagelines 
fa fa-paypal  
fa fa-pied-piper  
fa fa-pied-piper-alt  
fa fa-pinterest 
fa fa-pinterest-p 
fa fa-pinterest-square  
fa fa-product-hunt  
fa fa-qq  
fa fa-quora 
fa fa-ra  
fa fa-ravelry 
fa fa-rebel 
fa fa-reddit  
fa fa-reddit-alien  
fa fa-reddit-square 
fa fa-renren  
fa fa-safari  
fa fa-scribd  
fa fa-sellsy  
fa fa-share-alt 
fa fa-share-alt-square  
fa fa-shirtsinbulk  
fa fa-snapchat  
fa fa-snapchat-square 
fa fa-simplybuilt 
fa fa-skyatlas  
fa fa-skype 
fa fa-slack 
fa fa-slideshare  
fa fa-soundcloud  
fa fa-spotify 
fa fa-stack-exchange  
fa fa-stack-overflow  
fa fa-steam 
fa fa-steam-square  
fa fa-stumbleupon 
fa fa-stumbleupon-circle  
fa fa-superpowers 
fa fa-telegram  
fa fa-tencent-weibo 
fa fa-themeisle 
fa fa-trello  
fa fa-tripadvisor 
fa fa-tumblr  
fa fa-tumblr-square 
fa fa-twitch  
fa fa-twitter 
fa fa-twitter-square  
fa fa-usb 
fa fa-viacoin 
fa fa-viadeo  
fa fa-viadeo-square 
fa fa-vimeo 
fa fa-vimeo-square  
fa fa-vine  
fa fa-vk  
fa fa-wechat  
fa fa-weibo 
fa fa-weixin  
fa fa-whatsapp  
fa fa-wikipedia-w 
fa fa-windows 
fa fa-wordpress 
fa fa-wpbeginner  
fa fa-wpexplorer  
fa fa-wpforms 
fa fa-xing  
fa fa-xing-square 
fa fa-y-combinator  
fa fa-yahoo 
fa fa-yelp  
fa fa-yc  
fa fa-yoast 
fa fa-youtube 
fa fa-youtube-play  
fa fa-youtube-square










              <!-- Start latest-post Area -->
              <div class="post-area-wrapper">
                <h4 class="cat-title">Latest News (Change)</h4>
                <?php 
                  $args = array( 
                  'post_type' => 'post',
                  'posts_per_page' => 10);
                  $loop = new WP_Query( $args );
                ?>
                <?php
                if ( $loop->have_posts() ) :

                  /* Start the Loop */
                  while ( $loop->have_posts() ) :
                    $loop->the_post();
                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    
                    get_template_part( 'template-parts/content', 'blog' );

                  endwhile;
                  wp_reset_postdata();
                endif;
                ?>
              </div>
              <!-- End latest-post Area -->

              <!-- Start banner-ads Area -->
              <div class="col-lg-12 ad-widget-wrap mt-30 mb-30">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/img/banner-ad.jpg" alt="ad">
              </div>
              <!-- End banner-ads Area -->




              <!-- Start top-post Area -->
              <section class="post-feature post-area-wrapper">
                <div class="container no-padding">
                  <div class="row small-gutters">
                    <div class="col-lg-12 mb-10">
                      <h4 class="cat-title">Latest News (Change)</h4>
                    </div>

                <?php 
                  $args = array( 
                    'post_type' => 'post',
                    'posts_per_page' => 5
                  );
                  $loop = new WP_Query( $args );
                ?>    

                <?php 
                  if ( $loop->have_posts() ) : 
                    $count=(int)0; $mt='';


                    /* Start the Loop */
                    while ( $loop->have_posts() ) : $loop->the_post(); 
                      $class = ($count == 0)? 'col-lg-12 '.$mt : 'col-lg-6 mt-10';?>

                      <div class="<?php echo esc_attr( $class ); ?>">

                      <?php
                      /**
                       * Run the loop for the search to output the results.
                       * If you want to overload this in a child theme then include a file
                       * called content-search.php and that will be used instead.
                       */
                      if ($count == 0) {
                        front_page_post('feature-post-large');
                      }else{
                        front_page_post('feature-post-small');
                      }

                      $count++; 
                      if ($count == 3) {
                        $count=0;
                        $mt='mt-10';
                      }
                      ?>

                      </div>

                      <?php
                    endwhile;
                    wp_reset_postdata();

                  else :
                    get_template_part( 'template-parts/content', 'none' );
                  endif;
                ?>
                  </div>
                </div>
              </section>





<?php




/**
 * Multiselect option for WP Customizer
 *
 * @param $wp_customize
 */
add_action( 'customize_register', __NAMESPACE__ . '\\multiselect_customize_register' );
function multiselect_customize_register( $wp_customize ) {
  /**
   * Multiple select customize control class.
   */
  class Sinfonia_Customize_Control_Multiple_Select extends \WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     */
    public $type = 'multiple-select';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content() {

      if ( empty( $this->choices ) ) {
        return;
      }
      ?>




                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?> class="magazil-select-multipl" multiple="multiple">
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>















            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
          <?php
          foreach ( $this->choices as $value => $label ) {
            $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
            echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
          }
          ?>
                </select>
            </label>
    <?php }
  }
}







/**
 * Multiselect option for WP Customizer
 *
 * @param $wp_customize
 */
add_action( 'customize_register', __NAMESPACE__ . '\\multiselect_customize_register' );
function multiselect_customize_register( $wp_customize ) {
  /**
   * Multiple select customize control class.
   */
  class Sinfonia_Customize_Control_Multiple_Select extends \WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     */
    public $type = 'multiple-select';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content() {

      if ( empty( $this->choices ) ) {
        return;
      }
      ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
          <?php
          foreach ( $this->choices as $value => $label ) {
            $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
            echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
          }
          ?>
                </select>
            </label>
    <?php }
  }
}

/**
 * Get all categories
 * 
 * @return array
 */
function project_types() {
  $cats    = array();
  $cats[0] = 'None';
  foreach ( get_categories() as $categories => $category ) {
    $cats[ $category->term_id ] = $category->name;
  }

  return $cats;
}

/**
 * Validate the options against the existing categories
 *
 * @param  string[] $input
 *
 * @return string
 */
function project_types_sanitize( $input ) {
  $valid = project_types();

  foreach ( $input as $value ) {
    if ( ! array_key_exists( $value, $valid ) ) {
      return [];
    }
  }

  return $input;
}

// Credits: https://stackoverflow.com/questions/10936059/how-to-convert-items-in-array-to-a-comma-separated-string-in-php









/**
 * Get all categories
 * 
 * @return array
 */
function project_types() {
  $cats    = array();
  $cats[0] = 'None';
  foreach ( get_categories() as $categories => $category ) {
    $cats[ $category->term_id ] = $category->name;
  }

  return $cats;
}

/**
 * Validate the options against the existing categories
 *
 * @param  string[] $input
 *
 * @return string
 */
function project_types_sanitize( $input ) {
  $valid = project_types();

  foreach ( $input as $value ) {
    if ( ! array_key_exists( $value, $valid ) ) {
      return [];
    }
  }

  return $input;
}

// Credits: https://stackoverflow.com/questions/10936059/how-to-convert-items-in-array-to-a-comma-separated-string-in-php











<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class Customizer_category_Dropdown_Control extends WP_Customize_Control
 {
    private $cats = false;

    /**
    * The type of customize control being rendered.
    */
    public $type = 'multiple-select';

  /**
   * Enqueue scripts/styles.
   *
   * @since 3.4.0
   */
  public function enqueue() {
    wp_enqueue_script( 'magazil-select2', get_stylesheet_directory_uri() . '/inc/customizer/js/select2.min.js', array( 'jquery' ), rand(), true );
    wp_enqueue_script( 'magazil-select', get_stylesheet_directory_uri() . '/inc/customizer/js/select.js', array( 'jquery' ), rand(), true );
    wp_enqueue_style( 'magazil-select2', get_stylesheet_directory_uri() . '/inc/customizer/css/select2.min.css', array(), rand() );


  }


    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->cats = get_categories($options);
        parent::__construct( $manager, $id, $args );
    }
    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->cats))
            {
                ?>



            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
          <?php
          foreach ( $this->cats as $value => $label ) {
            $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
            echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
          }
          ?>
                </select>
            </label>













                

                <?php
            }
       }
 }
?>








            <div class="cs-range-value"><?php echo esc_attr($this->value()); ?></div>



            <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />



        <label>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <div class="cs-range-value"><?php echo esc_attr($this->value()); ?></div>
            <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
        </label>