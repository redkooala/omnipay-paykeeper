<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class OrderStatusRequest
 * @package Omnipay\PayKeeper\Message
 */
class OrderStatusRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getAction(): string
    {
        return '/info/options/byid/';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getParameter('id');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setId(int $value): self
    {
        return $this->setParameter('id', $value);
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('user', 'id', 'password');

        return [
            'id' => $this->getId(),
        ];
    }
}