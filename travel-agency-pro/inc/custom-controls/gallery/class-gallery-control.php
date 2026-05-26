<?php
/**
 * Gallery Control.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Rara_Gallery_Control' ) ) {

    class Rara_Gallery_Control extends WP_Customize_Control {
    
    	public $type = 'image_gallery';
    
    	public $file_type = 'image';
    
    	public $button_labels = array();
    
    	public function __construct( $manager, $id, $args = array() ) {
    		parent::__construct( $manager, $id, $args );
    
    		$this->button_labels = wp_parse_args( $this->button_labels, apply_filters( 'rara-gallery', array(
    			'select'       => __( 'Select Images', 'travel-agency-pro' ),
    			'change'       => __( 'Change Images', 'travel-agency-pro' ),
    			'default'      => __( 'Default', 'travel-agency-pro' ),
    			'remove'       => __( 'Remove', 'travel-agency-pro' ),
    			'placeholder'  => __( 'No images selected', 'travel-agency-pro' ),
    			'frame_title'  => __( 'Select Multiple Images', 'travel-agency-pro' ),
    			'frame_button' => __( 'Choose Images', 'travel-agency-pro' ),
    		) ) );
    	}
        
        public function enqueue() {            
            wp_enqueue_style( 'rara-gallery-css', get_template_directory_uri() . '/inc/custom-controls/gallery/gallery.css', null );
            wp_enqueue_script( 'rara-gallery', get_template_directory_uri() . '/inc/custom-controls/gallery/gallery.js', array( 'jquery', 'customize-controls' ), false, true ); //for slider        
        }
            
    	protected function content_template() {
    		$data = $this->json();
    		?>
    		<#
    
    		_.defaults( data, <?php echo wp_json_encode( $data ) ?> );
    		data.input_id = 'input-' + String( Math.random() );
    		#>
    			<span class="customize-control-title"><label for="{{ data.input_id }}">{{ data.label }}</label></span>
    		<# if ( data.attachments ) { #>
    			<div class="image-gallery-attachments">
    				<# _.each( data.attachments, function( attachment ) { #>
    					<div class="image-gallery-thumbnail-wrapper" data-post-id="{{ attachment.id }}">
    						<img class="attachment-thumb" src="{{ attachment.url }}" draggable="false" alt="" />
    					</div>
    				<#	} ) #>
    			</div>
    			<# } #>
    			<div>
    				<button type="button" class="button upload-button" id="image-gallery-modify-gallery">{{ data.button_labels.select }}</button>
                    <button type="button" class="button remove-button" id="image-gallery-clear-gallery">{{ data.button_labels.remove }}</button>
    			</div>
    			<div class="customize-control-notifications"></div>
    
    		<?php
    
    	}
    
    	public function to_json() {
    		parent::to_json();
    		$this->json['label'] = html_entity_decode( $this->label, ENT_QUOTES, get_bloginfo( 'charset' ) );
    		$this->json['file_type'] = $this->file_type;
    		$this->json['button_labels'] = $this->button_labels;
    	}
    
    }
}