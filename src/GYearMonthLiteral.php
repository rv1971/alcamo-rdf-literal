<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF gregorian year/month literal
 *
 * @date Last reviewed 2026-02-18
 */
class GYearMonthLiteral extends DateTimeLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'gYearMonth';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'Y-m';
}
