<?php

namespace alcamo\rdf_literal;

use alcamo\time\Duration;

/**
 * @brief RDF duration literal
 *
 * @date Last reviewed 2026-02-05
 */
class DurationLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'duration';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param $value Duration|string Duration or duration string.
     *
     * @param $datatypeUri Datatype IRI. [Default `xsd:duration`]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        parent::__construct(
            $value instanceof Duration ? $value : new Duration($value),
            $datatypeUri
        );
    }
}
