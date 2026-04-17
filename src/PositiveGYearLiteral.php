<?php

namespace alcamo\rdf_literal;

use alcamo\exception\OutOfRange;

/**
 * @brief RDF positive gregorian year literal
 *
 * @date Last reviewed 2026-02-22
 */
class PositiveGYearLiteral extends GYearLiteral
{
    use CustomTypeLiteralTrait;

    /// Local name of the default datatype
    public const DEFAULT_DATATYPE_LOCAL_NAME = 'PositiveGYear';

    /// Extended name of the default datatype
    public const DEFAULT_DATATYPE_XNAME =
        self::ALCAMO_RDF_NS . ' ' . self::DEFAULT_DATATYPE_LOCAL_NAME;

    /// Absolute path of the XSD file containing the type
    public const XSD_FILENAME = __DIR__ . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . 'xsd' . DIRECTORY_SEPARATOR . 'alcamo.rdf.xsd';

    protected function validateValue(): void
    {
        /** @throw alcamo::exception::OutOfRange if $value is a negative
         *  year. */
        OutOfRange::throwIfNegative($this->format('Y'));
    }
}
