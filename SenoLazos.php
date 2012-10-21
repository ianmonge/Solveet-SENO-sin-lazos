<?php

/**
 * Class SenoLazos
 */
class SenoLazos
{
    /**
     * Index of the positions.
     */
    const POSITION_VERTICAL     = 1;
    const POSITION_HORIZONTAL   = 0;

    /**
     * Current position.
     *
     * @var array
     */
    protected $currentPosition = array( 0, 0 );

    /**
     * Road.
     *
     * @var array
     */
    protected $road = array();

    /**
     * Constructs.
     */
    public function __construct() {
        $this->addCurrentPositionToRoad();
    }

    /**
     * Process the road input and return the optimized road.
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
     * Update the current position, according to the movement.
     *
     * @param string $move
     */
    protected function updateCurrentPosition( $move ) {
        switch ( $move ) {
            case 'S':
                $this->currentPosition[ self::POSITION_VERTICAL ]--;
                break;
            case 'N':
                $this->currentPosition[ self::POSITION_VERTICAL ]++;
                break;
            case 'O':
                $this->currentPosition[ self::POSITION_HORIZONTAL ]--;
                break;
            case 'E':
                $this->currentPosition[ self::POSITION_HORIZONTAL ]++;
                break;
        }
    }

    /**
     * Add the current position to the road.
     */
    protected function addCurrentPositionToRoad()
    {
        $this->road[] = $this->currentPosition;
    }

    /**
     * Optimize the road, trying to find the loop and removing them.
     */
    protected function optimizeRoad()
    {
        $indexesMatched = array_keys( $this->road, $this->currentPosition );

        // If the road passes by the same point twice.
        if ( 2 === count( $indexesMatched ) ) {
            $indexes = array_keys( $this->road );
            foreach ( $indexes as $index) {
                if ( $index > $indexesMatched[0] ) {
                    unset( $this->road[ $index ] );

                }
            }
        }
    }

    /**
     * Return the road output.
     */
    protected function getOutput()
    {
        $output = '';

        $indexes = array_keys( $this->road );
        foreach ( $indexes as $key => $index ) {
            if ( 0 === $index ) {
                continue;
            }

            $currentPosition  = $this->road[ $index ];
            $previousPosition = $this->road[ $indexes[ $key-1 ] ];
            $output .= $this->getMove( $previousPosition, $currentPosition );
        }

        return $output;
    }

    /**
     * Return the movement between the two posicions.
     *
     * @param array $startPosition
     * @param array $endPosition
     * @return string
     */
    protected function getMove( $startPosition, $endPosition )
    {
        $move = '';

        // If the move is vertical.
        if ( $endPosition[0] === $startPosition[0] ) {
            if ( $endPosition[1] > $startPosition[1] ) {
                $move = 'N';
            } else {
                $move = 'S';
            }
        // If the move is horizontal.
        } else {
            if ( $endPosition[0] > $startPosition[0] ) {
                $move = 'E';
            } else {
                $move = 'O';
            }
        }

        return $move;
    }
}
