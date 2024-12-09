<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

/**
 * Generate an encrypted or signed URL for a route
 *
 * @param string $routeName The route name
 * @param array $params The parameters for the route
 * @param bool $isEncrypted Whether the URL should be encrypted (default: true)
 * @return string The generated URL (encrypted or signed)
 */
function generateUrl($routeName, $params = [], $isEncrypted = true)
{
    if ($isEncrypted) {
        // Encrypt the generated URL
        $url = route($routeName, $params);
        return Crypt::encryptString($url);
    } else {
        // Generate a signed URL (use this for tamper-proof URLs)
        return URL::signedRoute($routeName, $params);
    }
}
