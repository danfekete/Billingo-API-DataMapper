<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\DataMapper\Contracts;

/**
 * Interface Resource
 * The base of the Data mapper pattern
 * @package Billingo\API\DataMapper
 */
interface Resource
{
    /**
     * Fill the resource with the attributes
     * @param array $attributes
     * @return mixed
     */
    public function fill(array $attributes);

    /**
     * Save the resource
     * @return mixed
     */
    public function save();

    /**
     * Delete resource
     * @return mixed
     */
    public function delete();

    /**
     * Load a resource by ID
     * @param $id
     * @return mixed
     */
    public function load($id);

    /**
     *
     * @return mixed
     */
    public function loadAll();
}