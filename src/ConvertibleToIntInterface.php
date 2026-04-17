<?php

namespace alcamo\rdf_literal;

/**
 * @brief Object providing a toInt() method.
 *
 * @date Last reviewed 2026-02-20
 */
interface ConvertibleToIntInterface
{
    public function toInt(): int;
}
