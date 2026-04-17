<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF media type literal
 *
 * @date Last reviewed 2026-02-12
 */
class MediaTypeLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'string';

    /*
     * Sadly, `xh11d:ContentType` defined in
     * https://www.w3.org/MarkUp/SCHEMA/xhtml-datatypes-1.xsd cannot be used
     * as a type here because it has no ID and therefore cannot be reference
     * via a simple URI.
     */
    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /*
     * @param $value MediaType|string MediaType or media type string.
     *
     * @param $datatypeUri Datatype IRI. [Default `xsd:string`]
     */
    public function __construct($value, $datatypeUri = null)
    {
        parent::__construct(
            $value instanceof MediaType
                ? $value
                : MediaType::newFromString($value),
            $datatypeUri
        );
    }
}
