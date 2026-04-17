<?php

namespace alcamo\rdf_literal;

use alcamo\uri\FileUriFactory;
use Psr\Http\Message\UriInterface;

/**
 * @brief RDF literal of a custom type
 *
 * @note A class using this trait must define the constants
 * `DEFAULT_DATATYPE_LOCAL_NAME` and `XSD_FILENAME`.
 *
 * @date Last reviewed 2026-04-17
 */
trait CustomTypeLiteralTrait
{
    public static function getClassDefaultDatatypeUri(): UriInterface
    {
        static $uris = [];

        return $uris[static::DEFAULT_DATATYPE_LOCAL_NAME]
        ?? ($uris[static::DEFAULT_DATATYPE_LOCAL_NAME]
            = (new FileUriFactory())
            ->create(static::XSD_FILENAME)
            ->withFragment(static::DEFAULT_DATATYPE_LOCAL_NAME));
    }
}
