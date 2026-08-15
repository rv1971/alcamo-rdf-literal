<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF string literal
 *
 * @invariant getValue() returns a string.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-02-09
 */
class StringLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . '#string';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value stringable.
     *
     * @param $datatypeUri Datatype IRI. [default static::DEFAULT_DATATYPE_URI]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct((string)$value, $datatypeUri);
    }
}
