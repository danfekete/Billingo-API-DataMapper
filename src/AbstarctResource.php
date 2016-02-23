<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\DataMapper;


use Billingo\API\Connector\HTTP\Request;
use Billingo\API\DataMapper\Contracts\Resource;

abstract class AbstarctResource implements Resource
{
    protected $endpoint;

    private $data = [];

    private $client;

    public $exists = false;

    /**
     * AbstarctResource constructor.
     * @param Request $client
     * @param bool $exists
     */
    public function __construct(Request $client, $exists=false)
    {
        $this->client = $client;
        $this->exists = $exists;
    }


    public function fill(array $attributes)
    {
        $this->data = $attributes;
    }

    public function save()
    {
        if($this->exists) $this->client->put($this->endpoint, $this->data);
        else $this->client->post($this->endpoint, $this->data);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function load($id)
    {
        // TODO: Implement load() method.
    }

    public function loadAll()
    {
        // TODO: Implement loadAll() method.
    }


}