<?php

namespace alcamo\rdf_literal;

use alcamo\uri\Uri;
use Psr\Http\Message\UriInterface;

/**
 * @brief RDF literal
 *
 * @attention Cloning is shallow, hence $value_ (if it is an object) is cloned
 * by reference. Applications should not modify the result of getValue(),
 * unless it is desired that the modification applies to all literals that
 * reference it.
 *
 * @date Last reviewed 2026-02-05
 */
abstract class AbstractLiteral implements LiteralInterface
{
    /**
     * @brief URI of underlying primitive datatype
     *
     * MUST be defined in derived classes.
     *
     * The constructors do not check whether a datatype given as a parameter
     * is indeed derived from this because this would create a considerable
     * overhead.
     */
    public const PRIMITIVE_DATATYPE_URI = null;

    /**
     * @brief URI of default datatype
     *
     * MAY be defined in derived classes.
     */
    public const DEFAULT_DATATYPE_URI = null;

    /// Return static::DEFAULT_DATATYPE_URI as an Uri object
    public static function getClassDefaultDatatypeUri(): UriInterface
    {
        static $uris = [];

        return $uris[static::class]
        ?? ($uris[static::class] = new Uri(static::DEFAULT_DATATYPE_URI));
    }

    protected $value_;
    protected $datatypeUri_; ///< UriInterface

    /**
     * @param $value in any appropriate PHP type.
     *
     * @param $datatypeUri Datatype IRI.
     */
    public function __construct($value = null, $datatypeUri = null)
    {
        /* Unwrap values wrapped into another literal class. This happens, for
         * instance, when OwlVersionInfo gets a LangStringLiteral (from an XML
         * attribute in a place where a language is defined). */
        $this->value_ =
            $value instanceof LiteralInterface ? $value->getValue() : $value;

        $this->datatypeUri_ = isset($datatypeUri)
            ? ($datatypeUri instanceof UriInterface
               ? $datatypeUri
               : new Uri($datatypeUri))
            : static::getClassDefaultDatatypeUri();

        if (isset($value)) {
            $this->validateValue();
        }
    }

    public function getValue()
    {
        return $this->value_;
    }

    public function getDatatypeUri(): UriInterface
    {
        return $this->datatypeUri_;
    }

    /** @return Always `null`. */
    public function getLang(): ?Lang
    {
        return null;
    }

    public function __toString(): string
    {
        return $this->value_;
    }

    public function getDigest(): string
    {
        return $this->value_;
    }

    public function equals(LiteralInterface $literal): bool
    {
        return $literal::PRIMITIVE_DATATYPE_URI == $this::PRIMITIVE_DATATYPE_URI
            && $literal->value_ == $this->value_;
    }

    /// Validate the object just after construction
    protected function validateValue(): void
    {
    }
}
