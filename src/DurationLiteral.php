<?php

namespace alcamo\rdf_literal;

use alcamo\time\Duration;

/**
 * @brief RDF duration literal
 *
 * @invariant getValue() returns an alcamo::time::Duration.
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
            $value instanceof Duration ? clone $value : new Duration($value),
            $datatypeUri
        );
    }

    public function __clone()
    {
        $this->value_ = clone $this->value_;
    }

    public function getValue()
    {
        /* Since Duration is derived from DateInterval, $this->value_ is not
         * immutable. To keep the literal immutable, always return a clone. */
        return clone $this->value_;
    }
}
