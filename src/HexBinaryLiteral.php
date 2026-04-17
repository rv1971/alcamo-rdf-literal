<?php

namespace alcamo\rdf_literal;

use alcamo\binary_data\BinaryString;

/**
 * @brief RDF hexBinary literal
 *
 * @date Last reviewed 2026-02-18
 */
class HexBinaryLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'hexBinary';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value BinaryString|string BinaryString or hex string.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct(
            $value instanceof BinaryString
                ? $value
                : BinaryString::newFromHex($value),
            $datatypeUri
        );
    }
}
