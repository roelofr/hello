<?php
declare(strict_types=1);

namespace Roelofr\Hello;

require_once __DIR__ . '/defines.php';
require_once APP_ROOT . '/vendor/autoload.php';

// Figure out the domain
$url = $_SERVER['HELLO_HOST'] ?? $_REQUEST['ref'] ?? '';

// Get the domain name
$domain = getDomainFromUrl($url);

// Get the HTML path
$htmlPath = APP_ROOT . '/html/index.html';
$cssPath = APP_ROOT . '/dist/main.css';

// Make sure the files exists.
if (!file_exists($htmlPath) || !is_file($htmlPath)) {
    http_response_code(500);
    exit;
}
if (!file_exists($cssPath) || !is_file($cssPath)) {
    http_response_code(500);
    exit;
}

// Get template and stylesheet content
$content = file_get_contents($htmlPath);
$stylesheet = file_get_contents($cssPath);

// Replace the '{domain}' with the requested domain name.
$content = str_replace(
    ['{{domain}}', '{domain}', '{{ domain }}', '{ domain }'],
    $domain,
    $content
);

// Replace the '{css}' with the stylesheet.
$content = str_replace(
    ['{{stylesheet}}', '{stylesheet}', '{{ stylesheet }}', '{ stylesheet }'],
    $stylesheet,
    $content
);

$contentLength = strlen($content);

http_response_code(200);
header('Content-Type: text/html;charset=utf-8');
header("Content-Length: {$contentLength}");

// Check for gzip support
if (preg_match('/(^|,)\s*gzip\s*($|,)/i', $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '')) {
    header('Content-Encoding: gzip');
    $content = gzencode($content);
}

echo $content;
