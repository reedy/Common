<?php

namespace ValueParsers\Test;

use DataValues\UnknownValue;
use ValueParsers\NullParser;
use ValueParsers\ValueParser;

/**
 * @covers ValueParsers\NullParser
 *
 * @group ValueParsers
 * @group DataValueExtensions
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class NullParserTest extends ValueParserTestBase {

	/**
	 * @see ValueParserTestBase::getInstance
	 *
	 * @return NullParser
	 */
	protected function getInstance() {
		return new NullParser();
	}

	/**
	 * @see ValueParserTestBase::validInputProvider
	 */
	public function validInputProvider() {
		return array(
			array( '42', new UnknownValue( '42' ) ),
			array( 42, new UnknownValue( 42 ) ),
			array( false, new UnknownValue( false ) ),
			array( array(), new UnknownValue( array() ) ),
			array( 'ohi there!', new UnknownValue( 'ohi there!' ) ),
			array( null, new UnknownValue( null ) ),
			array( 4.2, new UnknownValue( 4.2 ) ),
		);
	}

	/**
	 * @see ValueParserTestBase::invalidInputProvider
	 */
	public function invalidInputProvider() {
		return array( array( null ) );
	}

	/**
	 * @see ValueParserTestBase::testParseWithInvalidInputs
	 *
	 * @dataProvider invalidInputProvider
	 */
	public function testParseWithInvalidInputs( $value, ValueParser $parser = null ) {
		$this->markTestSkipped( 'NullParser has no invalid inputs' );
	}

}
