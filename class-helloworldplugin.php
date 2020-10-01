<?php
/**
Plugin Name:  Hello World
Description:  Custom plugin that prints hello world message into console on latest post.
Version:      0.0.1
Text Domain:  hello-world

@package hello-world
 */

/**
 * Class HelloWorldPlugin
 */
class HelloWorldPlugin {

	const VERSION = '0.0.1'; // plugin version.

	/**
	 * HelloWorldPlugin constructor
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'wp' ) );
	}

	/**
	 * Handler for "wp" hook
	 */
	public function wp() {
		if ( $this->is_latest_post() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
	}

	/**
	 * Checks either current page is latest post's single page.
	 *
	 * @return bool
	 */
	public function is_latest_post() {
		$ids = get_posts(
			array(
				'numberposts' => 1,
				'fields'      => 'ids',
			)
		);

		return ! empty( $ids ) && is_single( $ids );
	}

	/**
	 * Handler for "enqueue_scripts" hook
	 */
	public function enqueue_scripts() {
		wp_register_script( 'hello-world', plugin_dir_url( __FILE__ ) . '/js/helloworld.js', array( 'jquery' ), self::VERSION, true );
		wp_enqueue_script( 'hello-world' );
	}
}

new HelloWorldPlugin();
