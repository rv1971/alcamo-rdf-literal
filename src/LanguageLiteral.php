<?php

namespace alcamo\rdf_literal;

use alcamo\exception\InvalidType;

/**
 * @brief RDF language literal
 *
 * @invariant getValue() returns an alcamo::rdf_literal::Lang.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-02-05
 */
class LanguageLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . '#string';

    public const DEFAULT_DATATYPE_URI = self::XSD_NS . '#language';

    /*
     * @param $value Lang|string Lang or language string.
     *
     * @param $datatypeUri Datatype IRI. [Default `xsd:language`]
     */
    public function __construct($value, $datatypeUri = null)
    {
        /** @throw alcamo::exception::InvalidType if $value is `null` or emtpy
         *  since the empty string is not a valid language. */
        InvalidType::throwIfNullOrEmpty(
            $value,
            [ 'Lang', '<nonempty-string>' ]
        );

        parent::__construct(
            $value instanceof Lang ? $value : Lang::newFromString($value),
            $datatypeUri
        );
    }
}
