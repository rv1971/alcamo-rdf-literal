<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF gregorian year literal
 *
 * @date Last reviewed 2026-02-18
 */
class GYearLiteral extends DateTimeLiteral implements ConvertibleToIntInterface
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'gYear';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'Y';

    /**
     * @param $value DateTime|int|string DateTime or year integer or string.
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
                $dateTime = new \DateTime();

                $dateTime->setDate(
                    $value,
                    $dateTime->format('m'),
                    $dateTime->format('d')
                );

                parent::__construct($dateTime, $datatypeUri);
                return;

            default:
                $value = (string)$value;

                if ($value[0] == '-') {
                    $sign = -1;
                    $value = substr($value, 1);
                }

                $dateTime = \DateTime::createFromFormat(
                    ctype_digit($value) ? 'Y' : 'Ye',
                    $value
                );

                if (isset($sign)) {
                    $dateTime->setDate(
                        -$dateTime->format('Y'),
                        $dateTime->format('m'),
                        $dateTime->format('d')
                    );
                }

                parent::__construct($dateTime, $datatypeUri);
        }
    }

    public function toInt(): int
    {
        return $this->value_->format('Y');
    }
}
