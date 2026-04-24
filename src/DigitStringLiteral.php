<?php

namespace alcamo\rdf_literal;

use alcamo\exception\SyntaxError;

/**
 * @brief RDF digit string literal
 *
 * A digit string is a string made of digits. It differs from a nonnegative
 * integer by the fact that it can be of arbitrary length and that leading
 * zeros make a difference, i.e. the numeric string `007` is different from
 * `7`.
 *
 * @date Last reviewed 2026-04-17
 */
class DigitStringLiteral extends FourBitCharStringLiteral
{
    public const DEFAULT_DATATYPE_LOCAL_NAME = 'DigitString';

    public const DEFAULT_DATATYPE_XNAME =
        self::ALCAMO_RDF_NS . ' ' . self::DEFAULT_DATATYPE_LOCAL_NAME;

    protected function validateValue(): void
    {
        if (!ctype_digit($this->value_)) {
            /** @throw alcamo::exception::SyntaxError if $this->value_
             *  contains non-digit characters. */
            throw (new SyntaxError('{value} contains non-digits'))
                ->setMessageContext([ 'value' => $this->value_ ]);
        }
    }
}
