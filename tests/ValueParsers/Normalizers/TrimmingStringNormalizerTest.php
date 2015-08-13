<?php

namespace ValueParsers\Normalizers\Test;

use DataValues\StringValue;
use PHPUnit_Framework_TestCase;
use ValueParsers\Normalizers\TrimmingStringNormalizer;

/**
 * @covers ValueParsers\Normalizers\TrimmingStringNormalizer
 *
 * @group ValueParsers
 * @group DataValueExtensions
 *
 * @licence GNU GPL v2+
 * @author Thiemo Mättig
 */
class TrimmingStringNormalizerTest extends PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider stringProvider
	 */
	public function testNormalize( $value, $expected ) {
		$normalizer = new TrimmingStringNormalizer();
		$this->assertSame( $expected, $normalizer->normalize( $value ) );
	}

	public function stringProvider() {
		return array(
			'Empty' => array( '', '' ),
			'Trimmed' => array( 'a', 'a' ),
			'Spaces' => array( ' a ', 'a' ),
			'Controls' => array( "\n\r\ta\n\r\t", 'a' ),
			'Paragraph separator' => array( "\xE2\x80\xA9a\xE2\x80\xA9", 'a' ),
		);
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	public function testNormalizeException( $value ) {
		$normalizer = new TrimmingStringNormalizer();
		$this->setExpectedException( 'InvalidArgumentException' );
		$normalizer->normalize( $value );
	}

	public function invalidValueProvider() {
		return array(
			array( null ),
			array( true ),
			array( 1 ),
			array( new StringValue( '' ) ),
		);
	}

}
