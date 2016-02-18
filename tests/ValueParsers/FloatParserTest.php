<?php

namespace ValueParsers\Test;

use DataValues\NumberValue;
use ValueParsers\FloatParser;

/**
 * @covers ValueParsers\FloatParser
 * @covers ValueParsers\StringValueParser
 *
 * @group ValueParsers
 * @group DataValueExtensions
 * @group FloatParserTest
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class FloatParserTest extends StringValueParserTest {

	/**
	 * @see ValueParserTestBase::getInstance
	 *
	 * @return FloatParser
	 */
	protected function getInstance() {
		return new FloatParser();
	}

	/**
	 * @see ValueParserTestBase::validInputProvider
	 */
	public function validInputProvider() {
		return array(
			// Ignoring a single trailing newline is an intended PCRE feature
			array( "0\n", new NumberValue( 0.0 ) ),

			array( '0', new NumberValue( 0.0 ) ),
			array( '1', new NumberValue( 1.0 ) ),
			array( '42', new NumberValue( 42.0 ) ),
			array( '01', new NumberValue( 1.0 ) ),
			array( '9001', new NumberValue( 9001.0 ) ),
			array( '-1', new NumberValue( -1.0 ) ),
			array( '-42', new NumberValue( -42.0 ) ),

			array( '0.0', new NumberValue( 0.0 ) ),
			array( '1.0', new NumberValue( 1.0 ) ),
			array( '4.2', new NumberValue( 4.2 ) ),
			array( '0.1', new NumberValue( 0.1 ) ),
			array( '90.01', new NumberValue( 90.01 ) ),
			array( '-1.0', new NumberValue( -1.0 ) ),
			array( '-4.2', new NumberValue( -4.2 ) ),
		);
	}

	/**
	 * @see StringValueParserTest::invalidInputProvider
	 */
	public function invalidInputProvider() {
		$argLists = parent::invalidInputProvider();

		$invalid = array(
			// Trimming is currently not supported
			' 0 ',

			'foo',
			'',
			'--1',
			'1-',
			'1 1',
			'1,',
			',1',
			',1,',
			'one',
			'0x20',
			'+1',
			'1+1',
			'1-1',
			'1.2.3',
		);

		foreach ( $invalid as $value ) {
			$argLists[] = array( $value );
		}

		return $argLists;
	}

}
