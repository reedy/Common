<?php

namespace DataValues\Tests;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;

/**
 * @covers DataValues\MultilingualTextValue
 *
 * @since 0.1
 *
 * @group DataValue
 * @group DataValueExtensions
 *
 * @license GPL-2.0+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class MultilingualTextValueTest extends DataValueTest {

	/**
	 * @see DataValueTest::getClass
	 *
	 * @return string
	 */
	public function getClass() {
		return 'DataValues\MultilingualTextValue';
	}

	public function validConstructorArgumentsProvider() {
		return array(
			array( array() ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
			) ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				new MonolingualTextValue( 'de', 'foo' ),
			) ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				new MonolingualTextValue( 'de', 'bar' ),
			) ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				new MonolingualTextValue( 'de', ' foo bar baz foo bar baz foo bar baz foo bar baz foo bar baz foo bar baz ' ),
			) ),
		);
	}

	public function invalidConstructorArgumentsProvider() {
		return array(
			array( array( 42 ) ),
			array( array( false ) ),
			array( array( true ) ),
			array( array( null ) ),
			array( array( array() ) ),
			array( array( 'foo' ) ),

			array( array( 42 => 'foo' ) ),
			array( array( '' => 'foo' ) ),
			array( array( 'en' => 42 ) ),
			array( array( 'en' => null ) ),
			array( array( 'en' => true ) ),
			array( array( 'en' => array() ) ),
			array( array( 'en' => 4.2 ) ),

			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				false,
			) ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				'foobar',
			) ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				new MonolingualTextValue( 'en', 'bar' ),
			) ),
		);
	}

	public function testNewFromArray() {
		$array = array( array( 'text' => 'foo', 'language' => 'en' ) );
		$value = MultilingualTextValue::newFromArray( $array );
		$this->assertSame( $array, $value->getArrayValue() );
	}

	/**
	 * @dataProvider invalidArrayProvider
	 */
	public function testNewFromArrayWithInvalidArray( array $array ) {
		$this->setExpectedException( 'DataValues\IllegalValueException' );
		MultilingualTextValue::newFromArray( $array );
	}

	public function invalidArrayProvider() {
		return array(
			array( array( null ) ),
			array( array( '' ) ),
			array( array( array() ) ),
			array( array( array( 'en', 'foo' ) ) ),
		);
	}

	/**
	 * @dataProvider getSortKeyProvider
	 */
	public function testGetSortKey( array $monolingualValues, $expected ) {
		$value = new MultilingualTextValue( $monolingualValues );
		$this->assertSame( $expected, $value->getSortKey() );
	}

	public function getSortKeyProvider() {
		return array(
			array( array(), '' ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
			), 'enfoo' ),
			array( array(
				new MonolingualTextValue( 'en', 'foo' ),
				new MonolingualTextValue( 'de', 'bar' ),
			), 'enfoo' ),
		);
	}

	/**
	 * @dataProvider instanceProvider
	 */
	public function testGetTexts( MultilingualTextValue $texts, array $arguments ) {
		$actual = $texts->getTexts();

		$this->assertInternalType( 'array', $actual );
		$this->assertContainsOnlyInstancesOf( '\DataValues\MonolingualTextValue', $actual );
		$this->assertEquals( $arguments[0], array_values( $actual ) );
	}

	/**
	 * @dataProvider instanceProvider
	 */
	public function testGetValue( MultilingualTextValue $texts, array $arguments ) {
		$this->assertInstanceOf( $this->getClass(), $texts->getValue() );
	}

}
