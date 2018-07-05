<?php
class WP_Customize_Phome_Control extends WP_Customize_Control
{
    public $type = 'phone';
  
    /**
    * Enqueue scripts/styles.
    *
    * @since 3.4.0
    */
    public function enqueue() {

    wp_enqueue_script( 'magazil-intlTelInput', get_stylesheet_directory_uri() . '/inc/customizer/js/intlTelInput.js', array( 'jquery' ), '1.0.0', true );

    wp_enqueue_script( 'magazil-phone', get_stylesheet_directory_uri() . '/inc/customizer/js/phone.js', array( 'jquery','magazil-intlTelInput' ), '1.0.0', true );
    wp_enqueue_style( 'magazil-intlTelInput', get_stylesheet_directory_uri() . '/inc/customizer/css/intlTelInput.css', array(), '1.0.0' );


    wp_enqueue_style( 'magazil-phone', get_stylesheet_directory_uri() . '/inc/customizer/css/phone.css', array(), '1.0.0' );
    }

    public function render_content()
    {
        ?>




        <label>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>

                <input class="magazil-phone"  title="<?php echo esc_html($this->label); ?>" type="tel" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />

            <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
        </label>
        <?php
    }
}