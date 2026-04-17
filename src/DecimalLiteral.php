<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF decimal literal
 *
 * @date Last reviewed 2026-02-26
 */
class DecimalLiteral extends AbstractLiteral implements
    ConvertibleToIntInterface
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'decimal';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value float|int|string number or numeric string.
     *
     * @param $datatypeUri Datatype IRI. [default `xsd:decimal`]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct(
            (float)(int)$value == (float)$value ? (int)$value : (float)$value,
            $datatypeUri
        );
    }

    public function toInt(): int
    {
        return $this->value_;
    }
}
