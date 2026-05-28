<?php

namespace alcamo\rdf_literal;

/**
 * @brief Language tag as defined in RFC4646
 *
 * @sa [RFC4646](http://tools.ietf.org/html/rfc4646).
 *
 * @invariant Immutable class.
 *
 * @date Last reviewed 2025-10-16
 */
class Lang
{
    private $subtags_; ///< array

    public static function newFromPrimary(string $primary): self
    {
        return new self([ 'language' => $primary ]);
    }

    public static function newFromPrimaryAndRegion(
        string $primary,
        ?string $region
    ): self {
        return new self(
            isset($region)
                ? [ 'language' => $primary, 'region' => $region ]
                : [ 'language' => $primary ]
        );
    }

    /**  @return `null` if $lang is the empty string, conforming to
     * [Language Identification](https://www.w3.org/TR/xml/#sec-lang-tag)
     * in XML documents. */
    public static function newFromString(string $lang): ?self
    {
        return $lang != '' ? new self(\Locale::parseLocale($lang)) : null;
    }

    public static function newFromCurrentLocale(): self
    {
        return new self(\Locale::parseLocale(setlocale(LC_ALL, 0)));
    }

    /**
     * @brief Find the first item that is a best match for the desired
     * language, if any
     *
     * @parm $items iterable of objects that might implement
     * HavingLangInterface. If an object does, its language is obtaned from
     * its getLang() method, otherwise it is considered to be
     * language-agnostic.
     *
     * @param Lang|string|null $lang desired language. If '-' (and hence not a
     * valid language tag), the first language-agnostic item (if any) is
     * returned.
     *
     * @param $disableFallback Do not return a statement with a different
     * primary language subtag as a fallback. Language-agnostic statements or
     * statements with the same primary language subtag can always be returned
     * as fallbacks.
     */
    public static function findBestMatch(
        iterable $items,
        $lang = null,
        ?bool $disableFallback = null
    ) {
        $bestMatch = null;
        $bestMatchLevel = -2; /* Any allowed match will be better than this. */
        $firstItem = null;

        foreach ($items as $item) {
            if (!isset($firstItem)) {
                $firstItem = $item;

                /** Return the first item if $lang is `null` or the empty
                 *  string. */
                if (!isset($lang) || $lang == '') {
                    return $firstItem;
                }
            }

            $itemLang = $item instanceof HavingLangInterface
                ? $item->getLang()
                : null;

            /* When looking for a language-agnostic item:
             * - If a language-agnostic item is found, return it immediately.
             * - Otherwise, save it as the best match found so far, with a
             *   match level of -1 so that it is chosen only if fallback is
             *   allowed. */
            if ($lang == '-') {
                if (!isset($itemLang)) {
                    return $item;
                } else {
                    if (!isset($bestMatch)) {
                        $bestMatch = $item;
                    }

                    continue;
                }
            }

            /* When a language-agnostic item is found, save it as a best match
             * of level 0 if no better match has been found so far, so that it
             * can be chosen also if fallback is disabled. */
            if (!isset($itemLang)) {
                if ($bestMatchLevel < 0) {
                    $bestMatch = $item;
                    $bestMatchLevel = 0;
                }

                continue;
            }

            /* If a perfect match is found, return it immediately. */
            if ($itemLang == $lang) {
                return $item;
            }

            /* Otherwise, save the current item if is better than the
             * best match found so far. */
            $matchLevel = $itemLang->countCommonSubtags($lang);

            if ($matchLevel > $bestMatchLevel) {
                $bestMatch = $item;
                $bestMatchLevel = $matchLevel;
            }
        }

        /* Return the best match if its level is as least zero or if fallback
         * is allowed. Otherwise return 0. In particular, if $items is the
         * empty collection, return `null` which is the start value for the
         * best match. */
        return ($bestMatchLevel >= 0 || !$disableFallback)
            ? $bestMatch
            : null;
    }

    private function __construct(array $subtags)
    {
        $this->subtags_ = $subtags;
    }

    /// Representation using hyphens
    public function __toString(): string
    {
        return strtr(\Locale::composeLocale($this->subtags_), '_', '-');
    }

    /// Subtags as returned by Locale::parseLocale()
    public function getSubtags(): array
    {
        return $this->subtags_;
    }

    /// Primary language subtag
    public function getPrimary(): string
    {
        return $this->subtags_['language'];
    }

    /// Region subtag
    public function getRegion(): ?string
    {
        return $this->subtags_['region'] ?? null;
    }

    /**
     * @brief Count common subtags
     *
     * This is useful to identify the best match for a desired language tag in
     * a list of given language tags.
     *
     * @param Lang|string|`null` $lang Language tag to compare with.
     *
     * @return
     * - If $lang is not `null` and not the empty string and there are no common
     * subtags, return -1.
     * - If $lang is `null` or the empty string, return 0.
     * - Otherwise, return the number of common subtags. Subtags are compare
     * left to right. If two subtags are equal, they are counted as 1. If one
     * subtag is specified and the other one is unspecified, they are ignored,
     * and comparison continues. If both are specified and different,
     * comparison stops.
     */
    public function countCommonSubtags($lang = null): int
    {
        if (!isset($lang) || $lang == '') {
            return 0;
        }

        if (!($lang instanceof Lang)) {
            $lang = Lang::newFromString($lang);
        }

        $subtags1 = $this->subtags_;
        $subtags2 = $lang->subtags_;

        if ($subtags1['language'] != $subtags2['language']) {
            return -1;
        }

        $common = 1;

        unset($subtags1['language']);
        unset($subtags2['language']);

        foreach ($subtags1 as $subtag => $value) {
            if (!isset($subtags2[$subtag])) {
                continue;
            }

            if (strtolower($subtags2[$subtag]) != strtolower($value)) {
                break;
            }

            $common++;
        }

        return $common;
    }
}
