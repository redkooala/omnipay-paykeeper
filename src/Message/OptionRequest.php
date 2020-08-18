<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class OptionRequest
 * @package Omnipay\PayKeeper\Message
 */
class OptionRequest extends AbstractRequest
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
     * @return self
     */
    public function setId(int $value): self
    {
        return $this->setParameter('id', $value);
    }

    /**
     * @inheritdoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('user', 'id', 'password');

        return [
            'id' => $this->getId(),
        ];
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * @return string
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getUrl(): string
    {
        $data = $this->getData();

        return parent::getUrl() . '?' . http_build_query($data);
    }
}
