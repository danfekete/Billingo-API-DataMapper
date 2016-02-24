<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

use Billingo\API\Connector\HTTP\Request;
use Billingo\API\DataMapper\BillingoFactory;

require_once '../vendor/autoload.php';

$client = new Request([
    'public_key' => '',
    'private_key' => '',
]);
$factory = new BillingoFactory($client);
//$clients = $factory->make(\Billingo\API\DataMapper\Models\Clients::class)->load('1511187010');
$vat = $factory->makeFromName('vat')->loadAll();
dump($vat);