<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF float floating point number literal
 *
 * @date Last reviewed 2026-02-05
 */
class FloatLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'float';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value float|string Floating point number or string.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct((float)$value, $datatypeUri);
    }
}
