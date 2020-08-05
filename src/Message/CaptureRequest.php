<?php

namespace Omnipay\PayKeeper\Message;

class CaptureRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getAction(): string
    {
        return '/change/payment/capture/';
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
        $this->validate('user', 'id', 'password', 'token');

        return [
            'id' => $this->getId(),
            'token' => $this->getToken(),
        ];
    }
}