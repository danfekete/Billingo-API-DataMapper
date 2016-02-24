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
    'public_key' => '28729a55286ef14dc086224b8678261e',
    'private_key' => '483c09c3d7e3299db447e3ec48be5a626197c58d590280c59cdd020282a4a957112bb3d9e6e928f75232caa0eae8a531745a0ef2643d4eff3e7b7cb4fa463bab',
]);
$factory = new BillingoFactory($client);
//$clients = $factory->make(\Billingo\API\DataMapper\Models\Clients::class)->load('1511187010');
$vat = $factory->makeFromName('vat')->loadAll();
dump($vat);