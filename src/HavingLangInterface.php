<?php

namespace alcamo\rdf_literal;

/**
 * @brief Object providing a getLang() method.
 *
 * @date Last reviewed 2026-02-11
 */
interface HavingLangInterface
{
    public function getLang(): ?Lang;
}
