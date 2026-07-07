<?php

namespace alcamo\rdf_literal;

use alcamo\binary_data\ImmutableBinaryString;

/**
 * @brief RDF hexBinary literal
 *
 * @invariant getValue() returns an alcamo::binary_data::ImmutableBinaryString.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-02-18
 */
class HexBinaryLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . '#hexBinary';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value BinaryString|string BinaryString or hex string.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct(
            $value instanceof ImmutableBinaryString
                ? clone $value
                : ImmutableBinaryString::newFromHex($value),
            $datatypeUri
        );
    }

    public function __clone()
    {
        $this->value_ = clone $this->value_;
    }
}
