<?php /** @noinspection PhpUnused */

namespace Fhp\Segment\HNVSK;

use Fhp\Segment\BaseDeg;

/**
 * Class SicherheitsdatumUndUhrzeit
 * Data Element Group: Sicherheitsdatum und -uhrzeit (Version 2)
 *
 * @link https://www.hbci-zka.de/dokumente/spezifikation_deutsch/fintsv3/FinTS_3.0_Security_Sicherheitsverfahren_HBCI_Rel_20181129_final_version.pdf
 * Section: D
 *
 * @package Fhp\Segment\HNVSK
 */
class SicherheitsdatumUndUhrzeitV2 extends BaseDeg
{
    /**
     * 1: Sicherheitszeitstempel (STS)
     * 6: Certificate Revocation Time (CRT)
     * @var integer
     */
    public $datumUndZeitbezeichner = 1; // This library does not support recovation, so STS is all we need.
    /** @var string|null JJJJMMTT gemäß ISO 8601 */
    public $datum;
    /** @var string|null hhmmss gemäß ISO 8601, local time (no time zone support). */
    public $uhrzeit;

    /**
     * @return SicherheitsdatumUndUhrzeitV2 For the current time.
     */
    public static function now()
    {
        $result = new SicherheitsdatumUndUhrzeitV2();
        try {
            $now = new \DateTime('@' . time()); // Call unqualified time() for unit test mocking to work.
            $result->datum = $now->format('Ymd');
            $result->uhrzeit = $now->format('His');
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to get current date', 0, $e);
        }
        return $result;
    }
}
