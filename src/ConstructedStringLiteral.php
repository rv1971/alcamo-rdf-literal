<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF constructed literal of type string
 *
 * String literal made of a sequence of literals, which may be of any type.
 *
 * There is no way to create an XML Schema datatype that semantically
 * expresses a sequence of items of potentially different types, potentially
 * separated by something that is not whitespace (or no separator at
 * all). Therefore, this package adopts the same solution as in LangString
 * literals: an artificial datatype URI is used that does not resolve to an
 * XML Schema type.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-04-21
 */
class ConstructedStringLiteral extends AbstractConstructedLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'string';

    public const DEFAULT_DATATYPE_URI =
        self::ALCAMO_RDF_NS . 'ConstructedString';

    /**
     * @copybrief alcamo::rdf_literal::LiteralInterface::__toString
     *
     * @return Concatenation of the return values of the __toString() methods
     * of each item, separated by
     * alcamo::rdf_literal::ConstructedStringLiteral::SEPARATOR.
     */
    public function __toString(): string
    {
        return implode(static::SEPARATOR, $this->value_);
    }
}
