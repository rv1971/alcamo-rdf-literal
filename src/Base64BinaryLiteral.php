<?php

namespace alcamo\rdf_literal;

use alcamo\binary_data\BinaryString;

/**
 * @brief RDF base64Binary literal
 *
 * @date Last reviewed 2026-02-18
 */
class Base64BinaryLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'base64Binary';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value BinaryString|string BinaryString or base64 string.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct(
            $value instanceof BinaryString
                ? $value
                : new BinaryString(base64_decode($value, true)),
            $datatypeUri
        );
    }

    public function __toString(): string
    {
        return base64_encode($this->value_->getData());
    }
}
