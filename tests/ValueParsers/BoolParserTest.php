<?php

namespace ValueParsers\Test;

use DataValues\BooleanValue;
use ValueParsers\BoolParser;

/**
 * @covers ValueParsers\BoolParser
 * @covers ValueParsers\StringValueParser
 *
 * @group ValueParsers
 * @group DataValueExtensions
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class BoolParserTest extends StringValueParserTest {

	/**
	 * @see ValueParserTestBase::getInstance
	 *
	 * @return BoolParser
	 */
	protected function getInstance() {
		return new BoolParser();
	}

	/**
	 * @see ValueParserTestBase::validInputProvider
	 */
	public function validInputProvider() {
		return array(
			array( 'yes', new BooleanValue( true ) ),
			array( 'on', new BooleanValue( true ) ),
			array( '1', new BooleanValue( true ) ),
			array( 'true', new BooleanValue( true ) ),
			array( 'no', new BooleanValue( false ) ),
			array( 'off', new BooleanValue( false ) ),
			array( '0', new BooleanValue( false ) ),
			array( 'false', new BooleanValue( false ) ),

			array( 'YeS', new BooleanValue( true ) ),
			array( 'ON', new BooleanValue( true ) ),
			array( 'No', new BooleanValue( false ) ),
			array( 'OfF', new BooleanValue( false ) ),
		);
	}

	/**
	 * @see StringValueParserTest::invalidInputProvider
	 */
	public function invalidInputProvider() {
		$argLists = parent::invalidInputProvider();

		$invalid = array(
			'foo',
			'2',
		);

		foreach ( $invalid as $value ) {
			$argLists[] = array( $value );
		}

		return $argLists;
	}

}
