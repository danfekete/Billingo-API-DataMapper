<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\DataMapper;

class Route
{
    /**
     * @var string
     */
    private $uri;

	/**
	 * Route constructor.
	 * @param string $uri
	 */
	public function __construct($uri = '')
	{
        $this->uri = $uri;
    }

	/**
	 * Generate full path
	 * @param array $params
	 * @param bool $absolute
	 * @return string
	 */
	public function path($params=[], $absolute=false)
	{
		$paramsString = implode('/', (array)$params);
		return rtrim($this->uri, '/') . '/' . $paramsString;
	}
}