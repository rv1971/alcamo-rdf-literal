<?php

namespace alcamo\rdf_literal;

use alcamo\exception\SyntaxError;

/**
 * @brief RDF boolean literal
 *
 * @date Last reviewed 2026-04-17
 */
class BooleanLiteral extends AbstractLiteral implements
    ConvertibleToIntInterface
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'boolean';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /**
     * @param @param $value null|bool|int|string null, boolean, boolean
     * integer or boolean string.
     *
     * @param $datatypeUri Datatype IRI. [Default `xsd:boolean`]
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        switch (true) {
            case is_bool($value):
                parent::__construct($value, $datatypeUri);
                return;

            case !isset($value) || $value == 'false' || (string)$value === '0':
                parent::__construct(false, $datatypeUri);
                return;

            case $value == 'true' || (string)$value === '1':
                parent::__construct(true, $datatypeUri);
                return;

            default:
                /** @throw alcamo::exception::SyntaxError if $value is not a
                 *  boolean, 0 or 1, or a valid boolean string. */
                throw (new SyntaxError('{value} is not a valid boolean'))
                    ->setMessageContext([ 'value' => $value ]);
        }
    }

    /// Return `true` or `false`
    public function __toString(): string
    {
        return $this->value_ ? 'true' : 'false';
    }

    public function toInt(): int
    {
        return $this->value_;
    }
}
