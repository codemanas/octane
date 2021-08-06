<?php

namespace Codemanas\Themes\Octane;

class Bootstrap {
	public static $instance = null;

	/**
	 * @return Bootstrap|null
	 */
	public static function get_instance() {
		return ( is_null( self::$instance ) ) ? new self() : self::$instance;
	}

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
		add_action( 'wp_loaded', [ $this, 'register_styles' ] );

		//font needs to be added for the editor
		add_action( 'enqueue_block_editor_assets', [ $this, 'load_editor_assets' ] );

		//enqueue the main theme style
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_style' ] );

		//Excerpt Mods
		add_filter( 'excerpt_length', [ $this, 'set_excerpt_length' ] );

		//Display fallback image in case - post does not have featured image
		add_filter( 'post_thumbnail_html', [ $this, 'set_post_thumbnail_fallback' ] );
		$this->load_modules();
	}

	public function load_modules() {
		BlockPattern::get_instance();
	}

	public function theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'octane', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 400, 400 );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style(
			[
				'style.css'
			]
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}

	public function load_editor_assets() {
		wp_enqueue_style( 'octane-fonts-style' );
	}

	public function register_styles() {
		$font_families = array(
			'Quicksand:wght@300;400;500;600;700',
			'Work+Sans:wght@300;400;500;600;700',
			'Roboto:wght@100;300;400;500;700;900',
			'Roboto+Slab:wght@100;200;300;400;500;600;700;800;900',
			'Merriweather:wght@300;400;700;900'
		);

		$fonts_url = add_query_arg( array(
			'family'  => implode( '&family=', $font_families ),
			'display' => 'swap',
		), 'https://fonts.googleapis.com/css2' );

		wp_register_style( 'octane-fonts-style',
			$fonts_url,
			[],
			null
		);

		wp_register_style(
			'octane-style',
			get_template_directory_uri() . '/style.css',
			[ 'octane-fonts-style' ],
			wp_get_theme()->get( 'Version' )
		);
	}

	public function enqueue_style() {
		wp_enqueue_style( 'octane-style' );
	}

	/**
	 *
	 * @return int
	 */
	public function set_excerpt_length() {
		return 100;
	}

	public function set_post_thumbnail_fallback( $html ) {
		if ( $html == '' ) {
			$html = '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' ) . '" width="400px">';
		}

		return $html;
	}

}