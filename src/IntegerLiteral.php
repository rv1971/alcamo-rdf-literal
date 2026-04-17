<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF integer literal
 *
 * @date Last reviewed 2026-02-05
 */
class IntegerLiteral extends DecimalLiteral
{
    public const DEFAULT_DATATYPE_URI = self::XSD_NS . 'integer';

    /**
     * @param $value int|string Integer or integer string.
     *
     * @param $datatypeUri Datatype IRI. [default `xsd:integer`]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct((int)$value, $datatypeUri);
    }
}
