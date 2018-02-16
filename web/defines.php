<?php
declare(strict_types=1);
/**
 * Defines the application root (APP_ROOT) and a function to get a domain name
 * from a string.
 *
 * @author roelofr <github@roelof.io>
 */

namespace Roelofr\Hello;

use Pdp\Exception\SeriouslyMalformedUrlException;
use Pdp\Parser as DomainParser;
use Pdp\PublicSuffixListManager as DomainList;

define('APP_ROOT', dirname(__DIR__));

/**
 * Checks an arbitrary string for a domain name and returns it, but only if
 * it's valid.
 *
 * @param  string     $url URL to parse
 * @return strin|null      Parsed domain, or null if invalid
 */
function getDomainFromUrl(?string $url) : ?string
{
    // Skip if empty
    if (empty($url)) {
        return null;
    }

    $domainListManager = new DomainList();
    $domainParser = new DomainParser($domainListManager->getList());

    $url = trim($url);

    if (empty($url)) {
        return null;
    }

    try {
        $data = $domainParser->parseUrl($url);
        if ($data === null) {
            return null;
        }

        return trim((string) $data->host);
    } catch (SeriouslyMalformedUrlException $e) {
        return null;
    }
}

/**
 * Returns a domain from a set of queries.
 */
function getDomainFromUrls(array $domains) : ?string
{
    $out = null;
    while ($out == null) {
        $out = getDomainFromUrl(array_shift($domains));
    }
    return $out;
}
