<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF gregorian month literal
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-02-18
 */
class GMonthLiteral extends DateTimeLiteral implements
    ConvertibleToIntInterface
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'gMonth';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'm';

    /**
     * @param $value DateTime|string|int DateTime or month string or number.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        switch (true) {
            case $value instanceof \DateTimeInterface:
                parent::__construct($value, $datatypeUri);
                break;

            case !isset($value) || $value === '':
                parent::__construct(new \DateTimeImmutable(), $datatypeUri);
                break;

            case is_int($value):
                parent::__construct(
                    \DateTimeImmutable::createFromFormat('m', $value),
                    $datatypeUri
                );
                break;

            default:
                parent::__construct(
                    \DateTimeImmutable::createFromFormat(
                        ctype_digit($value) ? 'm' : 'me',
                        $value
                    ),
                    $datatypeUri
                );
        }
    }

    public function toInt(): int
    {
        return $this->value_->format('m');
    }
}
