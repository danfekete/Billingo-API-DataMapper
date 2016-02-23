<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\DataMapper;


use Billingo\API\Connector\HTTP\Request;
use Billingo\API\DataMapper\Contracts\Resource;
use Billingo\API\DataMapper\Exceptions\NewDeleteException;

abstract class AbstractResource implements Resource
{
    /*
     * The API endpoint this resource connects to
     */
    protected $endpoint;

    /*
     * Resource ID
     */
    protected $_id;

    /*
     * Resource attributes
     */
    private $attributes = [];

    /*
     * Should be TRUE when the resource already exists
     */
    public $exists = false;

    /*
     * Billingo API Client
     */
    private $client;

    /*
     * Route helper
     */
    private $router;

    /**
     * AbstarctResource constructor.
     * @param Request $client
     * @param bool $exists
     */
    public function __construct(Request $client, $exists=false)
    {
        $this->client = $client;
        $this->exists = $exists;
        $this->router = new Route($this->endpoint);
    }

    function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    function __get($name) {
        return $this->attributes[$name];
    }

    public function fill(array $attributes, $id=null)
    {
        $this->attributes = $attributes;
        if($id) {
            $this->exists = true;
            $this->_id = $id;
        }
    }

    public function save()
    {
        // update the resource or ..
        if($this->exists && $this->_id) $this->client->put($this->router->path($this->_id), $this->attributes);
        else {
            // create the resource
            $response = $this->client->post($this->router->path(), $this->attributes);
            $this->_id = $response['id'];
            $this->exists = true;
        }
    }

    public function delete()
    {
        if(!$this->exists || !isset($this->_id)) throw new NewDeleteException; // do not delete unsaved resources
        $this->client->delete($this->router->path($this->_id));
    }


    public function load($id)
    {
        $response = $this->client->get($this->router->path($id));
        $this->fill($response['attributes'], $response['id']);
    }

    public function loadAll()
    {
        $response = $this->client->get($this->router->path());
        $resources = [];
        foreach ($response as $item) {
            $res = new static($this->client);
            $res->fill($item['attributes'], $item['id']);
            $resources[] = $res;
        }

        return $resources;
    }


}