<?php

namespace Codemanas\Themes\Octane;

class BlockStyles {
	public static $instance = null;

	public static function get_instance() {
		return is_null( self::$instance ) ? new self() : self::$instance;
	}

	public function __construct() {
		$this->register_styles();
	}

	private function register_styles() {
		register_block_style(
			'core/columns',
			[
				'name'       => 'no-space-between',
				'label'      => __( 'No Space Between', 'octane' ),
				'is_default' => false,
			]
		);
		
		$this->register_heading_styles();
		
	}

	public function register_heading_styles(  ) {
		register_block_style(
			'core/heading',
			[
				'name'       => 'heading-underlined',
				'label'      => __( 'Heading - Underlined', 'octane' ),
				'is_default' => false,
			]
		);

		register_block_style(
			'core/heading',
			[
				'name'       => 'heading-dashed',
				'label'      => __( 'Heading - Dashed', 'octane' ),
				'is_default' => false,
			]
		);

		register_block_style(
			'core/heading',
			[
				'name'       => 'heading-dotted',
				'label'      => __( 'Heading - Dotted', 'octane' ),
				'is_default' => false,
			]
		);
	}

}