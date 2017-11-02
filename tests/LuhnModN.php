<?php

namespace Tests\AppBundle\Controller;

use PHPUnit\Framework\TestCase;

class LuhnModN extends TestCase
{
    /**
     * Tests calculated checksum and verification of the number 1234567890 (base 10) in all bases between 2 and 36.
     */
    public function testKnownChecksums()
    {
        $luhnModN = new \S4A\LuhnModN();

        $number = 1234567890;

        $correctResults = [
            2 => "10010011001011000000010110100100",
            3 => "100120010011122022002",
            4 => "10212112000231022",
            5 => "100120221330300",
            6 => "3223010240301",
            7 => "424104402035",
            8 => "111454013223",
            9 => "31610456807",
            10 => "12345678903",
            11 => "5839771463",
            12 => "2a55550162",
            13 => "168a0865aa",
            14 => "b9d6b5aa5",
            15 => "735b7d609",
            16 => "499602d2f",
            17 => "30288g3ag",
            18 => "20568ad0b",
            19 => "174b57c78",
            20 => "j5g0jea9",
            21 => "e8605e35",
            22 => "ajc3e260",
            23 => "87ifcgi8",
            24 => "6b1230i2",
            25 => "51ac8ffk",
            26 => "3pnfhmac",
            27 => "3511eki8",
            28 => "2fkfbqap",
            29 => "225ep2g0",
            30 => "1ko4m30r",
            31 => "1c3ou0k9",
            32 => "14pc0mi0",
            33 => "vi0m562",
            34 => "r5spaao",
            35 => "nhokiaf",
            36 => "kf12ois",
        ];

        for($base = 2; $base < 37; $base++){
            $numberInBase = base_convert($number, 10, $base);
            $numberWithChecksum = $luhnModN->createChecksum($numberInBase, $base);

            $this->assertEquals($correctResults[$base], $numberWithChecksum);
            $this->assertTrue($luhnModN->hasValidChecksum($numberWithChecksum, $base));
        }
    }

    /**
     * Tests generation and verification of checksum for 10000 random numbers and bases.
     */
    public function testRandomChecksums()
    {
        $luhnModN = new \S4A\LuhnModN();

        for($i = 0; $i < 10000; $i++){
            $number = mt_rand(0, PHP_INT_MAX);
            $base = mt_rand(2, 36);

            $numberInBase = base_convert($number, 10, $base);
            $numberWithChecksum = $luhnModN->createChecksum($numberInBase, $base);
            $this->assertEquals(strlen($numberInBase) + 1, strlen($numberWithChecksum),
                "Number with checksum (" . $numberWithChecksum . ") should be exact one position longer than number without checksum (" . $numberInBase . ")");
            $this->assertTrue($luhnModN->hasValidChecksum($numberWithChecksum, $base));
        }
    }
}
