<?php namespace BoundedContext\Contracts;

interface Versionable
{

    /**
     * Gets a version number.
     *
     * @return int
     */
    public function version();
}
