<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class RefundRequest
 * @package Omnipay\PayKeeper\Message
 */
class RefundRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getAction(): string
    {
        return '/change/payment/reverse/';
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
    public function getData(): array
    {
        $this->validate( 'id', 'amount', 'partial', 'password', 'token', 'user');

        return [
            'id' => $this->getId(),
            'amount' => $this->getAmount(),
            'partial' => $this->getPartial(),
            'token' => $this->getToken(),
        ];
    }

    /**
     * @return bool
     */
    public function getPartial(): bool
    {
        return $this->getParameter('partial');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPartial(bool $value): self
    {
        return $this->setParameter('partial', $value);
    }
}