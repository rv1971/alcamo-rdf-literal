<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF literal factory
 *
 * @date Last reviewed 2026-04-17
 */
interface LiteralFactoryInterface extends NamespaceConstantsInterface
{
    /**
     * @param $value in any appropriate PHP type.
     *
     * @param $datatypeUri Datatype IRI.
     *
     * @return Object of appropriate type. If $datatypeUri is given, the object
     * type is decided based on it, otherwise it is based on the PHP type
     * or class of $value.
     */
    public function create($value, $datatypeUri = null): LiteralInterface;
}
