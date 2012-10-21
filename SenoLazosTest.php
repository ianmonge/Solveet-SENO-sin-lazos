<?php

require_once 'SenoLazos.php';

/**
 * Tests the class SenoLazos.
 */
class SenoLazosTest extends PHPUnit_Framework_TestCase
{
    /**
     * Provider of road to process.
     *
     * @return array
     */
    public function getProvider()
    {
        return array(
            'SENO' => array(
                'SENO',
                '',
            ),
            'SSNN' => array(
                'SSNN',
                '',
            ),
            'SEEO' => array(
                'SEEO',
                'SE',
            ),
            'SEEESOONNO' => array(
                'SEEESOONNO',
                '',
            ),
            'SSNON' => array(
                'SSNON',
                'SON',
            ),
        );
    }

    /**
     * Tests the main process.
     *
     * @dataProvider getProvider
     */
    public function testMain( $input, $output )
    {
        $senoLazos = new SenoLazos();

        $result = $senoLazos->process( $input );

        $this->assertEquals( $result, $output );
    }
}