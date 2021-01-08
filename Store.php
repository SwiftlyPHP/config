<?php

namespace Swiftly\Config;

use Swiftly\Config\LoaderInterface;

/**
 * Container used to store and manipulate config values
 *
 * @author clvarley
 */
Class Store
{

    /**
     * Array of config values
     *
     * Assumed to be a multidimensional array in format <string, mixed>.
     *
     * @var array $values Config values
     */
    protected $values;

    /**
     * Creates a new config from the (optionally) provided values
     *
     * @param array $values Config values
     */
    public function __construct( array $values = [] )
    {
        $this->values = $values;
    }

    /**
     * Get config values from the given loader
     *
     * @param LoaderInterface $loader Config loader
     * @return void                   N/a
     */
    public function load( LoaderInterface $loader ) : void
    {
        $loader->load( $this );
    }

    // TODO: get, set, has
}
