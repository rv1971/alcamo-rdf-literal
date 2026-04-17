<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF time literal
 *
 * @date Last reviewed 2026-02-05
 */
class TimeLiteral extends DateTimeLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'time';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'H:i:s';
}
