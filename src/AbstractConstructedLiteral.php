<?php

namespace alcamo\rdf_literal;

use alcamo\collection\ReadonlyCollectionTrait;
use alcamo\exception\InvalidType;

/**
 * @brief RDF constructed literal
 *
 * String literal made of a sequence of literals, which may be of any type.
 *
 * There is no way to create an XML Schema datatype that semantically
 * expresses a sequence of items of potentially different types, potentially
 * separated by something that is not whitespace (or no separator at
 * all). Therefore, this package adopts the same solution as in LangString
 * literals: an artificial datatype URI is used that does not resolve to an
 * XML Schema type.
 *
 * The only possible primitive datatypes for a constructed literal are
 * `string`, `base64Binary` and `hexBinary` because they are the only
 * primitive datatypes whose value spaces have a concatenation
 * operation. `base64Binary` has the drawback that concatenation in the value
 * space and concatenation in the lexical space lead to different
 * results. Therefore, derived classes are provided for `string` and
 * `hexBinary` only.
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2026-04-21
 */
abstract class AbstractConstructedLiteral extends AbstractLiteral implements
    \Countable,
    \ArrayAccess,
    \Iterator
{
    use ReadonlyCollectionTrait;

    /// Separator used in __toString() and getDigest()
    public const SEPARATOR = '|';

    /**
     * @param $value Iterable of alcamo::rdf_literal::LiteralInterface objects.
     *
     * @param $datatypeUri Datatype IRI.
     *
     * Keys if $value are preserved, i.e. the created object supports
     * iteration and array access with the same keys as used in $value.
     */
    public function __construct(iterable $value = null, $datatypeUri = null)
    {
        foreach ($value as $key => $literal) {
            if (!($literal instanceof LiteralInterface)) {
                /** @throw alcamo::exception::InvalidType if an item in $value
                 *  is not a LiteralInterface object. */
                throw (new InvalidType())->setMessageContext(
                    [
                        'value' => $literal,
                        'expectedOneOf' => LiteralInterface::class
                    ]
                );
            }

            /* ReadonlyCollectionTrait accesses $data_. */
            $this->data_[$key] = clone $literal;
        }

        parent::__construct(null, $datatypeUri ?? static::DEFAULT_DATATYPE_URI);

        /* AbstractLiteral accesses $value_. */
        $this->value_ =& $this->data_;
    }

    /**
     * @copybrief alcamo::rdf_literal::LiteralInterface::getDigest()
     *
     * @return Concatenation of the return values of the getDigest() methods
     * of each item, separated by
     * alcamo::rdf_literal::ConstructedStringLiteral::SEPARATOR.
     */
    public function getDigest(): string
    {
        $result = [];

        foreach ($this->value_ as $item) {
            $result[] = $item->getDigest();
        }

        return implode(static::SEPARATOR, $result);
    }

    /**
     * @copybrief alcamo::rdf_literal::LiteralInterface::getDigest()
     *
     * The values of two constructed literals are considered equal if they
     * have the same number of items and corresponding items are considered
     * equal. The keys of the items are considered irrelevant.
     */
    public function equals(LiteralInterface $literal): bool
    {
        if (
            $literal::PRIMITIVE_DATATYPE_URI != $this::PRIMITIVE_DATATYPE_URI
                || count($literal) != count($this)
        ) {
            return false;
        }

        $this->rewind();

        foreach ($literal as $item) {
            if (!$item->equals($this->current())) {
                return false;
            }

            $this->next();
        }

        return true;
    }
}
