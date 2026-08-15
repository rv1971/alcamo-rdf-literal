<?php

namespace alcamo\rdf_literal;

use alcamo\exception\InvalidType;

/**
 * @brief RDF QName literal
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-02-26
 */
class QNameLiteral extends StringLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . '#QName';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value stringable.
     *
     * @param $datatypeUri Datatype IRI. [default static::DEFAULT_DATATYPE_URI]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        /** @throw alcamo::exception::InvalidType if $value is `null` or emtpy
         *  since the empty string is not a valid qualified name. */
        InvalidType::throwIfNullOrEmpty($value, '<nonempty-string>');

        parent::__construct((string)$value, $datatypeUri);
    }
}
