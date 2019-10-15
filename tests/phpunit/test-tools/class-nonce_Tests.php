<?php
namespace WpnoncesWrapperLibrary;

use WpnoncesWrapperLibrary as Base;

class Test_Nonce extends Base\TestCase {

	/**
	 * Test generate method.
	 */
	public function test_generate() {
		// Setup
		\WP_Mock::userFunction( 'wp_create_nonce', array(
			'times' => 1,
			'args' => array( 'foo' ),
			'return' => 'bar',
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->generate( 'foo' );

		// Verify
		$this->assertEquals( 'bar', $test );
	}

	/**
	 * Test generate_url method.
	 */
	public function test_generate_url() {
		// Setup
		\WP_Mock::userFunction( 'wp_nonce_url', array(
			'times' => 1,
			'args' => array(
				'foo',
				'bar',
				'z'
			),
			'return' => 'http://example.com/foo',
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->generate_url( 'foo', 'bar', 'z' );

		// Verify
		$this->assertEquals( 'http://example.com/foo', $test );
	}

	/**
	 * Test verify method.
	 */
	public function test_verify() {
		// Setup
		\WP_Mock::userFunction( 'wp_verify_nonce', array(
			'times' => 1,
			'args' => array(
				'foo',
				'bar'
			),
			'return' => 1,
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->verify( 'foo', 'bar' );

		// Verify
		$this->assertEquals( 1, $test );
	}

	/**
	 * Test field method.
	 */
	public function test_field() {
		// Setup
		\WP_Mock::userFunction( 'wp_nonce_field', array(
			'times' => 1,
			'args' => array(
				'foo',
				'bar',
				'referer',
				'echo'
			),
			'return' => '<input type="hidden" id="bar" name="bar" value="foo" />',
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->field( 'foo', 'bar', 'referer', 'echo' );

		// Verify
		$this->assertEquals( '<input type="hidden" id="bar" name="bar" value="foo" />', $test );
	}

	/**
	 * Test display_ays method.
	 */
	public function test_display_ays() {
		// Setup
		\WP_Mock::userFunction( 'wp_nonce_ays', array(
			'times' => 1,
			'args' => array(
				'foo'
			),
			'return' => 'The link you followed has expired.',
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->display_ays( 'foo' );

		// Verify
		$this->assertEquals( 'The link you followed has expired.', $test );
	}

	/**
	 * Test check_admin_referer method.
	 */
	public function check_admin_referer() {
		// Setup
		\WP_Mock::userFunction( 'check_admin_referer', array(
			'times' => 1,
			'args' => array(
				'foo',
				'bar'
			),
			'return' => true,
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->check_admin_referer( 'foo', 'bar' );

		// Verify
		$this->assertTrue( $test );
	}

	/**
	 * Test check_ajax_referer method.
	 */
	public function check_ajax_referer() {
		// Setup
		\WP_Mock::userFunction( 'check_ajax_referer', array(
			'times' => 1,
			'args' => array(
				'foo',
				'bar',
				'z'
			),
			'return' => true,
		) );

		// Act
		$nonce = new Nonce();
		$test  = $nonce->check_ajax_referer( 'foo', 'bar', 'z' );

		// Verify
		$this->assertTrue( $test );
	}

}
