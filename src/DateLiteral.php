<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF date literal
 *
 * @date Last reviewed 2026-02-05
 */
class DateLiteral extends DateTimeLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'date';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'Y-m-d';
}
