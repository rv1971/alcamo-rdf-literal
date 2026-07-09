<?php

namespace alcamo\rdf_literal;

use alcamo\exception\SyntaxError;

/**
 * @brief RDF four-bit character string literal
 *
 * A four-bit character string literal is a string made of digits and the six
 * ASCII characters following `9`, namely `:;<=>?`. It differs from a
 * hexBinary literal by the fact that it may have an odd number of characters
 * and it ises the characters `:;<=>?` instead of `ABCDEF`.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-04-17
 */
class FourBitCharStringLiteral extends StringLiteral
{
    use CustomTypeLiteralTrait;

    /// Local name of the default datatype
    public const DEFAULT_DATATYPE_LOCAL_NAME = 'FourBitCharString';

    /// Extended name of the default datatype
    public const DEFAULT_DATATYPE_XNAME =
        self::ALCAMO_RDF_NS . ' ' . self::DEFAULT_DATATYPE_LOCAL_NAME;

    /// Absolute path of the XSD file containing the type
    public const XSD_FILENAME = __DIR__ . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . 'xsd' . DIRECTORY_SEPARATOR . 'alcamo.rdf.xsd';

    protected function validateValue(): void
    {
        if (!ctype_xdigit(strtr($this->value_, ':;<=>?', 'ABCDEF'))) {
            /** @throw alcamo::exception::SyntaxError if $this->value_
             *  contains non-four-bit characters. */
            throw (new SyntaxError('{value} contains non-four-bit characters'))
                ->setMessageContext([ 'value' => $this->value_ ]);
        }
    }
}
