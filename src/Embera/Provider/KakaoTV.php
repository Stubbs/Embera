<?php
/**
 * KakaoTV.php
 *
 * @package Embera
 * @author Michael Pratt <yo@michael-pratt.com>
 * @link   http://www.michael-pratt.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Embera\Provider;

use Embera\Url;

/**
 * KakaoTV Provider
 * @link https://tv.kakao.com
 */
class KakaoTV extends ProviderAdapter implements ProviderInterface
{
    /** inline {@inheritdoc} */
    protected $endpoint = 'https://tv.kakao.com/oembed?format=json';

    /** inline {@inheritdoc} */
    protected static $hosts = [
        'tv.kakao.com'
    ];

    /** inline {@inheritdoc} */
    protected $httpsSupport = true;

    /** inline {@inheritdoc} */
    public function validateUrl(Url $url)
    {
        return (bool) (preg_match('~tv\.kakao\.com/channel/(?:v|l)/(?:[^/]+)$~i', (string) $url) ||
            preg_match('~tv\.kakao\.com/channel/([^/]+)/(live|clip)link/([^/]+)$~i', (string) $url));
    }

    /** inline {@inheritdoc} */
    public function normalizeUrl(Url $url)
    {
        $url->convertToHttps();
        $url->removeQueryString();
        $url->removeLastSlash();

        return $url;
    }

}
