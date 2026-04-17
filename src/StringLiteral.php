<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF string literal
 *
 * @date Last reviewed 2026-02-09
 */
class StringLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'string';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value stringable.
     *
     * @param $datatypeUri Datatype IRI. [default `xsd:string`]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct((string)$value, $datatypeUri);
    }
}
