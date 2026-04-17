<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF double floating point number literal
 *
 * @date Last reviewed 2026-02-26
 */
class DoubleLiteral extends FloatLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'double';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;
}
