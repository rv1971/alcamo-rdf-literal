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
     * @brief Literal classes to consider
     *
     * When the create() method is given an URI which correponds to
     * getClassDefaultDatatypeUri() for one of these classes, a literal of
     * this class will be created.
     */
    public const LITERAL_CLASSES = [
        AnyUriLiteral::class,
        Base64BinaryLiteral::class,
        BitStringLiteral::class,
        BooleanLiteral::class,
        DateLiteral::class,
        DateTimeLiteral::class,
        DecimalLiteral::class,
        DigitStringLiteral::class,
        DoubleLiteral::class,
        DurationLiteral::class,
        FloatLiteral::class,
        FourBitCharStringLiteral::class,
        GDayLiteral::class,
        GMonthDayLiteral::class,
        GMonthLiteral::class,
        GYearLiteral::class,
        GYearMonthLiteral::class,
        HexBinaryLiteral::class,
        IntegerLiteral::class,
        LanguageLiteral::class,
        NonNegativeIntegerLiteral::class,
        NotationLiteral::class,
        PositiveGYearLiteral::class,
        QNameLiteral::class,
        StringLiteral::class,
        TimeLiteral::class
    ];

    /**
     * @brief Additional mappings of RDF data type IRIs to classes
     *
     * This mapping is necessary because the present factory has no knowledge
     * about XML Schema types derived from other types.
     *
     * This mapping includes all non-primitive builtin types not derived from
     * `string`. The types derived from `string` do not need to be mentioned
     * because StringLiteral is the fallback literal type anyway.
     */
    public const DATATYPE_URI_TO_CLASS = [
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

    public static function getDatatypeUriToClass(): array
    {
        static $classToMap = [];

        if (!isset($classToMap[static::class])) {
            $map = static::DATATYPE_URI_TO_CLASS;

            foreach (static::LITERAL_CLASSES as $class) {
                $method = "$class::getClassDefaultDatatypeUri";

                $map[(string)$method()] = $class;
            }

            $classToMap[static::class] = $map;
        }

        return $classToMap[static::class];
    }

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
        $datatypeUriToClass = static::getDatatypeUriToClass();

        switch (true) {
            case isset($datatypeUri)
                && isset($datatypeUriToClass[(string)$datatypeUri]):
                $class = $datatypeUriToClass[(string)$datatypeUri];

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
