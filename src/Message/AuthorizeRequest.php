<?php

namespace Omnipay\PayKeeper\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class AuthorizeRequest
 *
 * @package Omnipay\PayKeeper\Message
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        $this->validate('amount', 'user', 'password', 'token');

        $data = [
            'pay_amount' => $this->getAmount(),
            'token' => $this->getToken(),
        ];

       // build optional params
        if ($email = $this->getClientEmail()) {
            $data['client_email'] = $email;
        }
        if ($serviceName = $this->getServiceName()) {
            $data['service_name'] = $serviceName;
        }
        if ($phone = $this->getPhone()) {
            $data['client_phone'] = $phone;
        }
        if ($clientID = $this->getClientId()) {
            $data['clientid'] = $clientID;
        }
        if ($orderId = $this->getOrderid()) {
            $data['orderid'] = $orderId;
        }

        return $data;
    }

    /**
     * Get the card token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

    /**
     * Sets the card token.
     *
     * @param string $value
     * @return $this
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
       return 'POST';
    }

    /**
     * @inheritdoc
     */
    public function getAction(): string
    {
        return '/change/invoice/preview/';
    }

    /**
     * @return string
     */
    public function getClientId(): ?string
    {
        return $this->getParameter('clientId');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setClientId(string $value): self
    {
        return $this->setParameter('clientId', $value);
    }

    /**
     * @return string
     */
    public function getOrderId(): ?string
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOrderId(string $value): self
    {
        return $this->setParameter('orderId', $value);
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
    public function setPhone(string $value): self
    {
        return $this->setParameter('phone', $value);
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->getParameter('phone');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setServiceName(string $value): self
    {
        return $this->setParameter('serviceName', $value);
    }

    /**
     * @return string|null
     */
    public function getServiceName(): ?string
    {
        return $this->getParameter('serviceName');
    }
}
