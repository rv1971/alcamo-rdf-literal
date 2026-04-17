<?php

namespace alcamo\rdf_literal;

use alcamo\uri\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @brief RDF anyURI literal
 *
 * @date Last reviewed 2026-02-18
 */
class AnyUriLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'anyURI';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value UriInterface|string UriInterface or URI string.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value, $datatypeUri = null)
    {
        parent::__construct(
            $value instanceof UriInterface ? $value : new Uri($value),
            $datatypeUri
        );
    }
}
