<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom tags control
 */
class Customizer_Text_Editor_Control extends WP_Customize_Control {

    /**
     * The type of control being rendered
     */
    public $type = 'editor';

    private $toolbar1 = '';




    /**
     * Enqueue our scripts and styles
     */
    public function enqueue(){
      wp_enqueue_script( 'magazil_tinimc__editor', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/js/custom-editor.js', array( 'jquery' ), '1.0', true );
      wp_enqueue_style( 'magazil_tinimc__editor', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/css/custom-editor.css', array(), '1.0', 'all' );
      wp_enqueue_editor();
    }
    /**
     * Pass our TinyMCE toolbar string to JavaScript
     */
    public function to_json() {
      parent::to_json();

      if ($this->type == 'editor') {
        $this->toolbar1 = 'formatselect bold italic underline bullist numlist alignleft aligncenter alignright link';
      }else if ($this->type == 'editor-news') {
       $this->toolbar1 = 'bullist link bold italic underline';
      }

      $this->json['magaziltinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : $this->toolbar1;
      $this->json['magaziltinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
    }
    /**
     * Render the control in the customizer
     */
    public function render_content(){
    ?>
      <div class="tinymce-control">
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php if( !empty( $this->description ) ) { ?>
          <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php } ?>
        <textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
      </div>
    <?php
    }

}