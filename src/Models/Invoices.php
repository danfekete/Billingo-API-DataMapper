<?php
/**
 * Copyright (c) 2016, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\DataMapper\Models;


use Billingo\API\DataMapper\AbstractResource;
use Billingo\API\DataMapper\Exceptions\UnsavedException;

class Invoices extends AbstractResource
{

    protected $endpoint = 'invoices';

    /**
     * Send the loaded invoice to the client
     */
    public function send()
    {
        if(!$this->saved()) throw new UnsavedException;
        $path = $this->router->path([$this->_id, 'send']);
        $this->client->get($path);
        return true;
    }


    /**
     * Cancel the invoice
     * @return static
     * @throws UnsavedException
     */
    public function cancel()
    {
        if(!$this->saved()) throw new UnsavedException;
        $path = $this->router->path([$this->_id, 'cancel']);
        $response = $this->client->get($path);

        $cancelInvoice = new static($this->client, true);
        $cancelInvoice->load($response['id']);

        return $cancelInvoice;
    }

    /**
     * Set invoice paid, or partially paid
     * @param $amount double The amount to be paid
     * @param $paymentMethodId int The payment method to use
     * @param string $date The date of the payment, if not set, today's date will be used
     * @throws UnsavedException
     */
    public function pay($amount, $paymentMethodId, $date=null)
    {
        if(!$this->saved()) throw new UnsavedException;
        if($date == null) $date = date('Y-m-d');
        $path = $this->router->path([$this->id, 'pay']);
        $this->client->get($path, ['amount' => $amount, 'payment_method' => $paymentMethodId, 'date' => $date]);
    }

}