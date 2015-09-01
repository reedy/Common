<?php

namespace ValueParsers\Normalizers;

use InvalidArgumentException;

/**
 * Most simple implementation of a StringNormalizer that does nothing but trimming whitespace, by
 * using the definition of "whitespace" in Unicode-enabled Perl regular expressions.
 *
 * @since 0.3.2
 *
 * @license GPL 2+
 * @author Thiemo Mättig
 */
class TrimmingStringNormalizer implements StringNormalizer {

	/**
	 * @param string $value
	 *
	 * @throws InvalidArgumentException if $value is not a string
	 * @return string the trimmed string
	 */
	public function normalize( $value ) {
		if ( !is_string( $value ) ) {
			throw new InvalidArgumentException( '$value must be a string' );
		}

		return preg_replace( '/^\s+|\s+$/u', '', $value );
	}

}
