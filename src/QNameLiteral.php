<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF QName literal
 *
 * @date Last reviewed 2026-02-26
 */
class QNameLiteral extends StringLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'QName';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;
}
