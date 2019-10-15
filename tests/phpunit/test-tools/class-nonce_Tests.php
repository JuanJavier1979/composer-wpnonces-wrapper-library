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
}
