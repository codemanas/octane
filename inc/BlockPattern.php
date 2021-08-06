<?php

namespace Codemanas\Themes\Octane;

class BlockPattern {
	public static $instance = null;
	public $directory = '';

	public static function get_instance() {
		return is_null( self::$instance ) ? new self() : self::$instance;
	}

	public function __construct() {
		$this->directory = get_theme_file_path();
		$this->register_pattern_categories();
		add_action( 'init', [ $this, 'register_patterns' ] );
	}

	/**
	 * Function to get pattern html
	 *
	 * @param $template_file
	 */
	public function get_pattern_part( $template_file ) {
		$content = '';
		if ( file_exists( $this->directory . '/block-patterns/' . esc_html( $template_file ) ) ) {
			ob_start();
			require_once $this->directory . '/block-patterns/' . esc_html( $template_file );
			$content = ob_get_clean();
		}

		return $content;
	}

	public function register_patterns() {
		register_block_pattern(
			'codemanas-octane/pricing-table',
			array(
				'title'       => __( 'Pricing Table', 'octane' ),
				'description' => _x( 'Pricing table.', 'Block pattern description', 'octane' ),
				'content'     => $this->get_pattern_part('pricing-table.html'),
				'categories'  => [ 'codemanas-octane' ]
			)
		);
	}

	public function register_pattern_categories() {
		register_block_pattern_category(
			'codemanas-octane',
			[ 'label' => __( 'Codemanas', 'octane' ) ]
		);
	}
}