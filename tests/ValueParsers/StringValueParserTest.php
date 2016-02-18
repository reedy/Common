<?php

namespace ValueParsers\Test;

use ValueParsers\ParserOptions;
use ValueParsers\StringValueParser;

/**
 * Unit test StringValueParser class.
 *
 * @since 0.1
 *
 * @group ValueParsers
 * @group DataValueExtensions
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
abstract class StringValueParserTest extends ValueParserTestBase {

	/**
	 * @see ValueParserTestBase::invalidInputProvider
	 */
	public function invalidInputProvider() {
		return array(
			array( true ),
			array( false ),
			array( null ),
			array( 4.2 ),
			array( array() ),
			array( 42 ),
		);
	}

	public function testSetAndGetOptions() {
		/** @var StringValueParser $parser */
		$parser = $this->getInstance();
		$options = new ParserOptions();
		$parser->setOptions( $options );
		$this->assertSame( $options, $parser->getOptions() );
	}

}
