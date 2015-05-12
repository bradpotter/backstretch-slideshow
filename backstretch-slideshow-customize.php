<?php
/**
 * Backstretch Slideshow
 *
 * @package   Backstretch_Slideshow
 * @author    Brad Potter
 * @license   GPL-2.0+
 * @link      http://www.bradpotter.com/plugins/backstretch-slideshow
 * @copyright Copyright (c) 2015, Brad Potter
 */
 
add_action( 'customize_register', 'backstretch_slideshow_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 0.9.0
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function backstretch_slideshow_customizer_register() {

	/**
	 * Customize Background Image Control Class
	 *
	 * @package WordPress
	 * @subpackage Customize
	 * @since 0.9.0
	 */
	class Backtretch_Slideshow_Image_Control extends WP_Customize_Image_Control {

		/**
		 * Constructor.
		 *
		 * If $args['settings'] is not defined, use the $id as the setting ID.
		 *
		 * @since 0.9.0
		 * @uses WP_Customize_Upload_Control::__construct()
		 *
		 * @param WP_Customize_Manager $manager
		 * @param string $id
		 * @param array $args
		 */
		public function __construct( $manager, $id, $args ) {
			$this->statuses = array( '' => __( 'No Image', 'backstretch-slideshow' ) );

			parent::__construct( $manager, $id, $args );

			$this->add_tab( 'upload-new', __( 'Upload New', 'backstretch-slideshow' ), array( $this, 'tab_upload_new' ) );
			$this->add_tab( 'uploaded',   __( 'Uploaded', 'backstretch-slideshow' ), array( $this, 'tab_uploaded' ) );
			
			if ( $this->setting->default )
				$this->add_tab( 'default',  __( 'Default', 'backstretch-slideshow' ), array( $this, 'tab_default_background' ) );

			// Early priority to occur before $this->manager->prepare_controls();
			add_action( 'customize_controls_init', array( $this, 'prepare_control' ), 5 );
		}

		/**
		 * @since 0.9.0
		 * @uses WP_Customize_Image_Control::print_tab_image()
		 */
		public function tab_default_background() {
			$this->print_tab_image( $this->setting->default );
		}
		
	}

	global $wp_customize;

	$wp_customize->add_section( 'backstretch-slideshow-controls', array(
		'title'    => __( 'Backstretch Slideshow', 'backstretch-slideshow' ),
		'description'    => __( '<p>Load up to three images below to display in the Backstretch Slideshow. Adjust the settings that follow as preferred.</p>', 'backstretch-slideshow' ),
		'priority' => 75,
	) );

	$wp_customize->add_setting( 'backstretch-slideshow-home-image-one', array(
		'default'  => sprintf( '%s/images/blank1.jpg', BSS_URL ),
		'type'     => 'option',
	) );
	 
	$wp_customize->add_control(
		new Backtretch_Slideshow_Image_Control(
			$wp_customize,
			'home-background-image-one',
			array(
				'label'       => __( 'Image One', 'backstretch-slideshow' ),
				'section'     => 'backstretch-slideshow-controls',
				'settings'    => 'backstretch-slideshow-home-image-one',
			)
		)
	);

	$wp_customize->add_setting( 'backstretch-slideshow-home-image-two', array(
		'default'  => sprintf( '%s/images/blank2.jpg', BSS_URL ),
		'type'     => 'option',
	) );
	 
	$wp_customize->add_control(
		new Backtretch_Slideshow_Image_Control(
			$wp_customize,
			'home-background-image-two',
			array(
				'label'       => __( 'Image Two', 'backstretch-slideshow' ),
				'section'     => 'backstretch-slideshow-controls',
				'settings'    => 'backstretch-slideshow-home-image-two',
			)
		)
	);

	$wp_customize->add_setting( 'backstretch-slideshow-home-image-three', array(
		'default'  => sprintf( '%s/images/blank3.jpg', BSS_URL ),
		'type'     => 'option',
	) );
	 
	$wp_customize->add_control(
		new Backtretch_Slideshow_Image_Control(
			$wp_customize,
			'home-background-image-three',
			array(
				'label'       => __( 'Image Three', 'backstretch-slideshow' ),
				'section'     => 'backstretch-slideshow-controls',
				'settings'    => 'backstretch-slideshow-home-image-three',
			)
		)
	);
}

add_action( 'customize_register', 'backstretch_slideshow_customizer_options' );
/**
 * Adds settings and controls to the customizer
 */
function backstretch_slideshow_customizer_options( $wp_customize ) {


	$wp_customize->add_setting(
		'backstretch_slideshow_container',
		array(
			'default'   => sprintf( '.home-featured' ),
			'type'      => 'option',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'slide_container',
		array(
			'label'      => __( 'Container', 'backstretch-slideshow' ),
			'section'    => 'backstretch-slideshow-controls',
			'settings'   => 'backstretch_slideshow_container',
			'type'   	=> 'text',
		)
	);
	
	$wp_customize->add_setting(
		'backstretch_slideshow_slide_duration',
		array(
			'default'           => sprintf( '5000' ),
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'slide_duration',
		array(
			'label'      => __( 'Slide Duration', 'backstretch-slideshow' ),
			'section'    => 'backstretch-slideshow-controls',
			'settings'   => 'backstretch_slideshow_slide_duration',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting(
		'backstretch_slideshow_fade_duration',
		array(
			'default'           => sprintf( 'normal' ),
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_fade_duration',
		)
	);

	$wp_customize->add_control(
		'fade_duration',
		array(
			'label'      => __( 'Fade Duration', 'backstretch-slideshow' ),
			'section'    => 'backstretch-slideshow-controls',
			'settings'   => 'backstretch_slideshow_fade_duration',
			'type'   	=> 'select',
			'choices'    => array(
				'slow' => 'Slow',
				'normal' => 'Normal',
				'fast' => 'Fast',
        		),
		)
	);

	$wp_customize->add_setting(
		'backstretch_slideshow_overlay_color',
		array(
			'default'           => '#000000',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'overlay_color',
		array(
			'label'      => __( 'Overlay Color', 'backstretch-slideshow' ),
			'section'    => 'backstretch-slideshow-controls',
			'settings'   => 'backstretch_slideshow_overlay_color',
			'type'   	=> 'text',
		)
	);

	$wp_customize->add_setting(
		'backstretch_slideshow_overlay_opacity',
		array(
			'default'           => '00',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'overlay_opacity',
		array(
			'label'      => __( 'Overlay Opacity', 'backstretch-slideshow' ),
			'section'    => 'backstretch-slideshow-controls',
			'settings'   => 'backstretch_slideshow_overlay_opacity',
			'type'   	=> 'text',
		)
	);
}

function sanitize_fade_duration( $value ) {
    if ( ! in_array( $value, array( 'slow', 'normal', 'fast' ) ) )
        $value = 'normal';
 
    return $value;
}