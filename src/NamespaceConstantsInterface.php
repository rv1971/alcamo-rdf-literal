<?php

namespace alcamo\rdf_literal;

/**
 * @brief Namespace constants needed in many places
 *
 * @date Last reviewed 2026-02-05
 */
interface NamespaceConstantsInterface
{
    public const RDF_NS = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
    public const XSD_NS = 'http://www.w3.org/2001/XMLSchema#';

    /// Namespace for additional datatypes defined in this package
    public const ALCAMO_RDF_NS = 'tag:rv1971@web.de,2021:alcamo:ns:rdf#';
}
