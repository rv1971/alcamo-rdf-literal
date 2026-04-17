<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF gregorian day literal
 *
 * @date Last reviewed 2026-02-18
 */
class GDayLiteral extends DateTimeLiteral implements ConvertibleToIntInterface
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'gDay';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'd';

    /**
     * @param $value DateTime|string|int DateTime or day string or number.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        switch (true) {
            case $value instanceof \DateTime:
                parent::__construct($value, $datatypeUri);
                break;

            case !isset($value) || $value === '':
                parent::__construct(new \DateTime(), $datatypeUri);
                return;

            case is_int($value):
                parent::__construct(
                    \DateTime::createFromFormat('d', $value),
                    $datatypeUri
                );
                return;

            default:
                parent::__construct(
                    \DateTime::createFromFormat(
                        ctype_digit($value) ? 'd' : 'de',
                        $value
                    ),
                    $datatypeUri
                );
        }
    }

    public function toInt(): int
    {
        return $this->value_->format('d');
    }
}
