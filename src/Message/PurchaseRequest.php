<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class AuthorizeRequest
 *
 * @package Omnipay\PayKeeper\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        $this->validate('pay_amount',  'user', 'password');

        $data = [
            'pay_amount' => $this->getAmount(),
            'user' => $this->getUser(),
            'password' => $this->getPassword(),
        ];

        $additionalParams = [
            'clientid',
            'orderid',
            'client_email',
            'service_name',
            'client_phone'
        ];

        return $this->specifyAdditionalParameters($data, $additionalParams);
    }

    /**
     * @inheritdoc
     */
    public function getAction(): string
    {
        return '/change/invoice/preview/';
    }

    /**
     * @return int
     */
    public function getClientid(): string
    {
        return $this->getParameter('clientid');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setClientId(string $value): self
    {
        return $this->setParameter('clientid', $value);
    }


    /**
     * @return int
     */
    public function getOrderid(): string
    {
        return $this->getParameter('orderid');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOrderid(string $value): self
    {
        return $this->setParameter('orderid', $value);
    }


    /**
     * @param string $value
     * @return $this
     */
    public function setClientEmail(string $value): self
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return string|null
     */
    public function getClientEmail(): ?string
    {
        return $this->getParameter('email');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setClientPhone(string $value): self
    {
        return $this->setParameter('phone', $value);
    }

    /**
     * @return string|null
     */
    public function getClientPhone(): ?string
    {
        return $this->getParameter('phone');
    }


    /**
     * @param string $value
     * @return $this
     */
    public function setServiceName(string $value): self
    {
        return $this->setParameter('service_name', $value);
    }

    /**
     * @return string|null
     */
    public function getServiceName(): ?string
    {
        return $this->getParameter('service_name');
    }
}
