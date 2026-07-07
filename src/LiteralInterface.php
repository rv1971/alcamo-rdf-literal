<?php

namespace alcamo\rdf_literal;

use Psr\Http\Message\UriInterface;

/**
 * @brief RDF literal
 *
 * @sa [RDF Literals](https://www.w3.org/TR/2014/REC-rdf11-concepts-20140225/#section-Graph-Literal)
 *
 * @invariant Implementations should be immutable and always return immutable
 * objects in getValue().
 *
 * @date Last reviewed 2026-02-05
 */
interface LiteralInterface extends
    HavingDigestInterface,
    LiteralOrNodeInterface,
    NamespaceConstantsInterface
{
    /**
     * @brief Default datatype URI for objects of the given class
     *
     * A class supports at least all datatypes derived from the default one.
     */
    public static function getClassDefaultDatatypeUri(): UriInterface;

    /// Value as an appropriate PHP type, not necessarily stringable
    public function getValue();

    /// URI representing the datatype of the present object
    public function getDatatypeUri(): UriInterface;

    /// Language, if available
    public function getLang(): ?Lang;

    /// String representation of value
    public function __toString(): string;

    /**
     * @brief Whether $this and $literal are considered equal
     *
     * This is the case if:
     * - both PHP classes have the same primitive datatype
     * - AND the values are equal.
     *
     * Indeed, [XML Schema Part 2](https://www.w3.org/TR/xmlschema-2/#equal)
     * states that *the value spaces of all primitive datatypes are
     * disjoint*. Hence the underlying primitive datatype makes a difference
     * while the actual datatype does not.
     */
    public function equals(self $literal): bool;
}
