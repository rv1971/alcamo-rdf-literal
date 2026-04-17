<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF notation literal
 *
 * @date Last reviewed 2026-02-26
 */
class NotationLiteral extends QNameLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'NOTATION';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;
}
