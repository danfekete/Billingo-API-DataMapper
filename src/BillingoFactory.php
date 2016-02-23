<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\DataMapper;


use Billingo\API\Connector\HTTP\Request;

class BillingoFactory
{
    private $client;

    /**
     * BillingoFactory constructor.
     * @param $client
     */
    public function __construct(Request $client)
    {
        $this->client = $client;
    }

    /**
     * Return new model
     * @param $model
     * @return Resource
     */
    public function make($model)
    {
        return new $model($this->client);
    }
}