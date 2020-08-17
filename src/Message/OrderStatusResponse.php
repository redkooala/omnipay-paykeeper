<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class OrderStatusResponse
 * @package Omnipay\PayKeeper\Message
 */
class OrderStatusResponse extends Response
{
    public function isSuccessful(): bool
    {
        return !empty($this->data);
    }

    /**
     * @return mixed
     */
    public function getData(): array
    {
        return $this->data[0];
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->data[0]['status'];
    }
}
