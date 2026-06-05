<?php

namespace alcamo\rdf_literal;

use alcamo\binary_data\ImmutableBinaryString;

/**
 * @brief RDF constructed literal of type hexBinary
 *
 * HexBinary literal made of a sequence of literals, which may be of any type.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-04-21
 */
class ConstructedHexBinaryLiteral extends AbstractConstructedLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'hexBinary';

    public const DEFAULT_DATATYPE_URI =
        self::ALCAMO_RDF_NS . 'ConstructedHexBinary';

    /**
     * @copybrief alcamo::rdf_literal::LiteralInterface::__toString
     *
     * @return Hex-encoded representation of the concatenation of
     * - the binary item content, if the item value is an ImmutableBinaryString
     * - the return value of the __toString() method, otherwise
     * for each item, separated by
     * alcamo::rdf_literal::ConstructedStringLiteral::SEPARATOR.
     */
    public function __toString(): string
    {
        $result = [];

        foreach ($this->value_ as $item) {
            $result[] = bin2hex(
                $item->getValue() instanceof ImmutableBinaryString
                    ? $item->getValue()->getData()
                    : $item
            );
        }

        return strtoupper(implode(bin2hex(static::SEPARATOR), $result));
    }
}
