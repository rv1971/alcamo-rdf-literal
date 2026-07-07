<?php

namespace alcamo\rdf_literal;

use alcamo\xml\NamespaceConstantsInterface as BaseNamespaceConstantsInterface;

/**
 * @brief Namespace constants needed in many places
 *
 * @date Last reviewed 2026-07-07
 */
interface NamespaceConstantsInterface extends BaseNamespaceConstantsInterface
{
    /// Namespace for additional datatypes defined in this package
    public const ALCAMO_RDF_NS = 'tag:rv1971@web.de,2021:alcamo:ns:rdf#';
}
