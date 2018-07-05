<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 class Customizer_Select_Dropdown_Control extends WP_Customize_Control
 {
    // private $cats = false;

    /**
    * The type of customize control being rendered.
    */
    public $type = 'multiple';

  /**
   * Enqueue scripts/styles.
   *
   * @since 3.4.0
   */
  public function enqueue() {

    wp_enqueue_script( 'magazil-chosen', get_stylesheet_directory_uri() . '/inc/customizer/js/chosen.jquery.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'magazil-select', get_stylesheet_directory_uri() . '/inc/customizer/js/select.js', array( 'jquery','magazil-chosen' ), '1.0.0', true );
    wp_enqueue_style( 'magazil-chosen', get_stylesheet_directory_uri() . '/inc/customizer/css/chosen.css', array(), '1.0.0' );
  }


    public function __construct($manager, $id, $args = array(), $options = array())
    {
        // $this->cats = get_categories($options);
        parent::__construct( $manager, $id, $args );
    }
    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if ( empty( $this->choices ) ) {
                return;
              }
                ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select <?php $this->link(); ?> class="chosen-select" <?php echo esc_attr($this->type); ?> tabindex="4">
                <?php
                  $selected = '';
                  foreach ( $this->choices as $value => $label ) {
                  if (is_array($this->value())){
                    $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                  }else{
                    $selected = selected( $value, $this->value(), false);
                  }
                  printf('<option value="%s" %s>%s</option>', esc_attr( $value ), $selected, $label);
                  }
                ?>
                </select>
            </label>

          <?php
       }
 }
?>