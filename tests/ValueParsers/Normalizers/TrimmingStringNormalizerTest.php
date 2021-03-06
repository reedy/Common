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
 * @license GPL-2.0-or-later
 * @author Thiemo Kreuz
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
		return [
			'Empty' => [ '', '' ],
			'Trimmed' => [ 'a', 'a' ],
			'Spaces' => [ ' a ', 'a' ],
			'Controls' => [ "\n\r\ta\n\r\t", 'a' ],
			'Paragraph separator' => [ "\xE2\x80\xA9a\xE2\x80\xA9", 'a' ],
		];
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
		return [
			[ null ],
			[ true ],
			[ 1 ],
			[ new StringValue( '' ) ],
		];
	}

}
