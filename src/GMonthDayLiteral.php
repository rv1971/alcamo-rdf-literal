<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF gregorian month/day literal
 *
 * @date Last reviewed 2026-02-18
 */
class GMonthDayLiteral extends DateTimeLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'gMonthDay';

    public const DEFAULT_DATATYPE_URI = self::PRIMITIVE_DATATYPE_URI;

    /// Format content as ISO 8601 string without timezone
    public const FORMAT = 'm-d';

    /**
     * @param $value DateTime|string DateTime or month-day string.
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

            default:
                /* Simply try parsing $value with timezone; if this fails, try
                 * without. */
                $dateTime = \DateTime::createFromFormat('m-de', $value);

                if ($dateTime === false) {
                    $dateTime = \DateTime::createFromFormat('m-d', $value);
                }

                parent::__construct($dateTime, $datatypeUri);
        }
    }
}
