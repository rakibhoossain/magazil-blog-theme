<?php
class WP_Customize_Range_Control extends WP_Customize_Control
{
    public $type = 'magazil_range';
  
    /**
    * Enqueue scripts/styles.
    *
    * @since 3.4.0
    */
    public function enqueue() {

    wp_enqueue_script( 'magazil-range', get_stylesheet_directory_uri() . '/inc/customizer/js/range.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_style( 'magazil-range', get_stylesheet_directory_uri() . '/inc/customizer/css/range.css', array(), '1.0.0' );

    }

    public function render_content()
    {
        ?>

        <label>
            <?php if ( ! empty( $this->label )) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>


            <div class="range-slider">
                <input class="range-slider__range"  title="<?php echo esc_html($this->label); ?>" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
                <span class="range-slider__value"><?php echo esc_attr($this->value()); ?></span>
            </div>

            <?php if ( ! empty( $this->description )) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
        </label>
        <?php
    }
}