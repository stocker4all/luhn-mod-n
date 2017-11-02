<?php

namespace S4A;

/**
 * Class LuhnModN
 *
 * Creates and verifies checksums based on Luhn mod n algorithm.
 * Supported bases (values for n) are between 2 and 36.
 *
 * @link http://docs.phpdoc.org/references/phpdoc/tags/link.html Luhn mod N algorithm
 *
 * @package S4A
 */
class LuhnModN
{
    /**
     * Calculates the luhn checksum for a number in a base between 2 and 36.
     * If `$returnCompleteNumber` is not defined or set to true the method will return the given number with the added
     * checksum, otherwise the method will return only the checksum.
     *
     * @param string $number A number in the given base for which the checksum needs to be calculated.
     * @param int $base The base of the given number. Must be a value between 2 and 36.
     * @param bool $returnCompleteNumber If set to true, the method will return the given number with the added
     * checksum, otherwise the method will return the checksum only.

     * @return string the number with the checksum added or only the checksum depending on value of `$returnCompleteNumber`.
     */
    public function createChecksum($number, $base, $returnCompleteNumber = true){
        assert($base > 1 && $base < 37, "Base needs to be between 2 and 36.");

        $number = strtolower($number);

        $factor = 2;
        $sum = 0;

        for($i = strlen($number) - 1; $i >= 0; $i--){
            $chrNumber = base_convert(substr($number, $i, 1), $base, 10);
            $addend = $factor * $chrNumber;

            $factor = $factor == 2 ? 1 : 2;

            $sum += intdiv($addend, $base) + ($addend % $base);
        }

        $remainder = $sum % $base;
        $chrNumber = ($base - $remainder) % $base;

        $checkSum = base_convert($chrNumber,10, $base);

        return $returnCompleteNumber ? $number . $checkSum : $checkSum;

    }

    /**
     * Checks if the given number in a base between 2 and 36 has a valid luhn checksum.
     *
     * @param string $number A number in the given base for which the checksum needs to be validated.
     * @param int $base The base of the given number. Must be a value between 2 and 36.

     * @return bool true if checksum is valid, false otherwise.
     */
    public function hasValidChecksum($number, $base){
        assert($base > 1 && $base < 37, "Base needs to be between 2 and 36.");

        $number = strtolower($number);

        $factor = 1;
        $sum = 0;

        for($i = strlen($number) - 1; $i >= 0; $i--){
            $chrNumber = base_convert(substr($number, $i, 1), $base, 10);
            $addend = $factor * $chrNumber;

            $factor = $factor == 2 ? 1 : 2;

            $sum += intdiv($addend, $base) + ($addend % $base);
        }

        $remainder = $sum % $base;

        return $remainder == 0;
    }

    /**
     * Removes the checksum from the given number.
     *
     * @param string $number number with checksum.
     * @return string number without checksum.
     */
    public function numberWithoutChecksum($number){
        return substr($number, 0, -1);
    }

    /**
     * Extracts the checksum from the given number.
     *
     * @param $number number with checksum.
     * @return string checksum.
     */
    public function extractChecksum($number){
        return substr($number, -1);
    }
}