<?php

class NifTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @dataProvider nifProvider
     *
     * @param integer $number
     * @param integer $expected
     */
    public function generatesNifChecksum($number, $expected)
    {
        $checksummedNumber = Crybat_Nif::generate($number);

        $this->assertInternalType('integer', $checksummedNumber);
        $this->assertEquals($expected, $checksummedNumber);
    }

    /**
     * @return array
     */
    public function nifProvider()
    {
        return array(
            array(23560088, 235600881),
            array(22161539, 221615393),
            array(11624766, 116247665),
            array(50000175, 500001758),
            array(99300000, 993000002),
        );
    }

    /**
     * @test
     * @dataProvider nifValidProvider
     *
     * @param integer $number
     */
    public function validateNifChecksum($number)
    {
        $this->assertTrue(Crybat_Nif::isValid($number));
    }

    /**
     * @return array
     */
    public function nifValidProvider()
    {
        return array(
            array(235600881),
            array(221615393),
            array(116247665),
            array(500001758),
            array(993000002),
            array(123456789),
        );
    }

    /**
     * @test
     * @dataProvider nifInvalidProvider
     *
     * @param integer $number
     */
    public function validateInvalidNifChecksum($number)
    {
        $this->assertFalse(Crybat_Nif::isValid($number));
    }

    public function nifInvalidProvider()
    {
        return array(
            array(235600882),
            array(221615392),
            array(116247664),
            array(500001757),
            array(993000001),
            array(123456788),
            array(987654321),
            array(1)
        );
    }

}