<?php

require_once 'SenoLazos.php';

class SenoLazosTest extends PHPUnit_Framework_TestCase
{
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
     * @dataProvider getProvider
     */
    public function testMain( $input, $output )
    {
        $senoLazos = new SenoLazos();

        $result = $senoLazos->process( $input );

        $this->assertEquals( $result, $output );
    }
}