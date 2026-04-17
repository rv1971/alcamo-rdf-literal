<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF literal factory
 *
 * @date Last reviewed 2026-02-05
 */
class LiteralFactory implements LiteralFactoryInterface
{
    /**
     * @brief Mapping of RDF data type IRIs to classes
     *
     * This mapping includes all primitive types and all builtin types dnot
     * derived from `string`. The types derived from `string` do not need to
     * be mentioned because StringLiteral is the fallback literal type anyway.
     */
    public const DATATYPE_URI_TO_CLASS = [
        AnyUriLiteral::DEFAULT_DATATYPE_URI       => AnyUriLiteral::class,
        Base64BinaryLiteral::DEFAULT_DATATYPE_URI => Base64BinaryLiteral::class,
        BooleanLiteral::DEFAULT_DATATYPE_URI      => BooleanLiteral::class,
        DateLiteral::DEFAULT_DATATYPE_URI         => DateLiteral::class,
        DateTimeLiteral::DEFAULT_DATATYPE_URI     => DateTimeLiteral::class,
        DecimalLiteral::DEFAULT_DATATYPE_URI      => DecimalLiteral::class,
        DoubleLiteral::DEFAULT_DATATYPE_URI       => DoubleLiteral::class,
        DurationLiteral::DEFAULT_DATATYPE_URI     => DurationLiteral::class,
        FloatLiteral::DEFAULT_DATATYPE_URI        => FloatLiteral::class,
        GDayLiteral::DEFAULT_DATATYPE_URI         => GDayLiteral::class,
        GMonthDayLiteral::DEFAULT_DATATYPE_URI    => GMonthDayLiteral::class,
        GMonthLiteral::DEFAULT_DATATYPE_URI        => GMonthLiteral::class,
        GYearLiteral::DEFAULT_DATATYPE_URI        => GYearLiteral::class,
        GYearMonthLiteral::DEFAULT_DATATYPE_URI   => GYearMonthLiteral::class,
        HexBinaryLiteral::DEFAULT_DATATYPE_URI    => HexBinaryLiteral::class,
        IntegerLiteral::DEFAULT_DATATYPE_URI      => IntegerLiteral::class,
        LanguageLiteral::DEFAULT_DATATYPE_URI     => LanguageLiteral::class,
        MediaTypeLiteral::DEFAULT_DATATYPE_URI    => MediaTypeLiteral::class,
        NonNegativeIntegerLiteral::DEFAULT_DATATYPE_URI
            => NonNegativeIntegerLiteral::class,
        NotationLiteral::DEFAULT_DATATYPE_URI     => NotationLiteral::class,
        QNameLiteral::DEFAULT_DATATYPE_URI        => QNameLiteral::class,
        StringLiteral::DEFAULT_DATATYPE_URI       => StringLiteral::class,
        TimeLiteral::DEFAULT_DATATYPE_URI         => TimeLiteral::class,

        self::XSD_NS . 'byte'               => IntegerLiteral::class,
        self::XSD_NS . 'int'                => IntegerLiteral::class,
        self::XSD_NS . 'long'               => IntegerLiteral::class,
        self::XSD_NS . 'negativeInteger'    => IntegerLiteral::class,
        self::XSD_NS . 'nonPositiveInteger' => IntegerLiteral::class,
        self::XSD_NS . 'positiveInteger'    => NonNegativeIntegerLiteral::class,
        self::XSD_NS . 'short'              => IntegerLiteral::class,
        self::XSD_NS . 'unsignedByte'       => NonNegativeIntegerLiteral::class,
        self::XSD_NS . 'unsignedInt'        => NonNegativeIntegerLiteral::class,
        self::XSD_NS . 'unsignedLong'       => NonNegativeIntegerLiteral::class,
        self::XSD_NS . 'unsignedShort'      => NonNegativeIntegerLiteral::class
    ];

    /**
     * @param $value stringable
     *
     * @param $datatypeUri Datatype IRI. [Default `xsd:string`]
     *
     * @param $lang Lang object or language string. Considered only if a
     * LangStringLiteral is returned, i.e. if either the datatype is that of
     * language-tagged string or $lang is not `null` and the type to return
     * could not be deduced neither from the type of $value nor from
     * $datatypeUri.
     */
    public function create(
        $value,
        $datatypeUri = null,
        $lang = null
    ): LiteralInterface {
        switch (true) {
            case isset($datatypeUri)
                && isset(static::DATATYPE_URI_TO_CLASS[(string)$datatypeUri]):
                $class = static::DATATYPE_URI_TO_CLASS[(string)$datatypeUri];

                return new $class($value, $datatypeUri);

            case is_bool($value):
                return new BooleanLiteral($value, $datatypeUri);

            case is_float($value):
                return new FloatLiteral($value, $datatypeUri);

            case is_int($value):
                return new IntegerLiteral($value, $datatypeUri);

            case $value instanceof \DateTimeInterface:
                return new DateTimeLiteral($value, $datatypeUri);

            case $value instanceof \DateInterval:
                return new DurationLiteral($value, $datatypeUri);

            case $value instanceof Lang:
                return new LanguageLiteral($value, $datatypeUri);

            case $datatypeUri == LangStringLiteral::DEFAULT_DATATYPE_URI:
            case isset($lang):
                return new LangStringLiteral($value, $lang, $datatypeUri);

            default:
                return new StringLiteral($value, $datatypeUri);
        }
    }
}
