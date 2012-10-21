<?php

class SenoLazos
{
    protected $currentPosition = array( 0, 0 );
    protected $road = array();

    /**
     *
     */
    public function __construct() {
        $this->addCurrentPositionToRoad();
    }

    /**
     *
     * @param string $input
     * @return string
     */
    public function process( $input )
    {
        $length = strlen( $input );
        for ( $i = 0; $i < $length; $i++ ) {
            $move = $input[ $i ];

            $this->updateCurrentPosition( $move );
            $this->addCurrentPositionToRoad();
            $this->optimizeRoad();
        }

        $output = $this->getOutput();

        return $output;
    }

    /**
     *
     * @param string $move
     */
    protected function updateCurrentPosition( $move ) {
        switch ( $move ) {
            case 'S':
                $this->currentPosition[1]--;
                break;
            case 'N':
                $this->currentPosition[1]++;
                break;
            case 'O':
                $this->currentPosition[0]--;
                break;
            case 'E':
                $this->currentPosition[0]++;
                break;
        }
    }

    /**
     *
     */
    protected function addCurrentPositionToRoad()
    {
        $this->road[] = $this->currentPosition;
    }

    /**
     *
     */
    protected function optimizeRoad()
    {
        $roadLength = count( $this->road );

        $positionsRepeated = array_keys( $this->road, $this->currentPosition );

        if ( 2 === count( $positionsRepeated ) ) {
            $positions = array_keys( $this->road );
            foreach ( $positions as $position) {
                if ( $position > $positionsRepeated[0] ) {
                    unset( $this->road[ $position ] );

                }
            }
        }
    }

    /**
     *
     */
    protected function getOutput()
    {
        $output = '';

        $positions = array_keys( $this->road );
        foreach ( $positions as $key => $position) {
            if ( 0 === $position ) {
                continue;
            }

            $currentPosition = $this->road[ $position ];
            $previousPosition = $this->road[ $positions[ $key-1 ] ];
            $output .= $this->getMove( $currentPosition, $previousPosition );
        }

        return $output;
    }

    protected function getMove( $currentPosition, $previousPosition )
    {
        $move = '';

        if ( $currentPosition[0] === $previousPosition[0] ) {
            if ( $currentPosition[1] > $previousPosition[1] ) {
                $move = 'N';
            } else {
                $move = 'S';
            }
        } else {
            if ( $currentPosition[0] > $previousPosition[0] ) {
                $move = 'E';
            } else {
                $move = 'O';
            }
        }

        return $move;
    }
}
