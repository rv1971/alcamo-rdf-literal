<?php

namespace alcamo\rdf_literal;

/**
 * @brief RDF language-tagged string
 *
 * @date Last reviewed 2026-02-05
 */
class LangStringLiteral extends AbstractLiteral
{
    public const PRIMITIVE_DATATYPE_URI = self::XSD_NS . 'string';

    public const DEFAULT_DATATYPE_URI = self::RDF_NS . 'langString';

    private $lang_; ///< ?Lang

    /**
     * @param $value stringable
     *
     * @param $lang Lang object or language string.
     *
     * @param $datatypeUri Datatype IRI. [Default `xsd:langString`]
     */
    public function __construct(
        $value = null,
        $lang = null,
        $datatypeUri = null
    ) {
        parent::__construct((string)$value, $datatypeUri);

        if (isset($lang)) {
            $this->lang_ =
                $lang instanceof Lang ? $lang : Lang::newFromString($lang);
        }
    }

    /** Currently the only class that may return non-`null`. */
    public function getLang(): ?Lang
    {
        return $this->lang_;
    }

    public function getDigest(): string
    {
        return "\"$this->value_\"" .
            (isset($this->lang_) ? "@$this->lang_" : '');
    }


    /**
     * @copydoc alcamo::rdf_literal::LiteralInterface::equals()
     *
     * If $literal is also a LangString and has a different language, the
     * literals are considered different. Otherwise the rules of
     * alcamo::rdf_literal::LiteralInterface::equals() apply.
     */
    public function equals(LiteralInterface $literal): bool
    {
        if ($literal instanceof self && $literal->lang_ != $this->lang_) {
            return false;
        }

        return parent::equals($literal);
    }
}
