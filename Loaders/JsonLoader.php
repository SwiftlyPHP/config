<?php

namespace Swiftly\Config\Loader;

use Swiftly\Config\{
    LoaderInterface,
    Store
};

/**
 * Class for loading and parsing json config files
 *
 * @author clvarley
 */
Class JsonLoader Implements LoaderInterface
{

    /**
     * Path to the config JSON file
     *
     * @var string $filename File path
     */
    protected $filename;

    /**
     * Creates a loader for the given config file
     *
     * @param string $filename File path
     */
    public function __construct( string $filename )
    {
        $this->filename = $filename;
    }

    /**
     * Loads values from the JSON file into the given store
     *
     * @param Store $config Config store
     * @return Store        Updated store
     */
    public function load( Store $config ) : Store
    {
        // TODO:

        return $config;
    }

    // TODO: 
}
