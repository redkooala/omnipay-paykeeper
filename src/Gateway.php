<?php

namespace Omnipay\PayKeeper;

use Omnipay\PayKeeper\Message\PurchaseRequest;
use Omnipay\PayKeeper\Message\CaptureRequest;
use Omnipay\PayKeeper\Message\OrderStatusRequest;
use Omnipay\PayKeeper\Message\RefundRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Gateway
 * @package Omnipay\PayKeeper\
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = array())
 */
class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'PayKeeper';
    }

    /**
     * @inheritdoc
     */
    public function getShortName(): string
    {
        return 'paykeeper';
    }

    /**
     * @inheritdoc
     */
    public function getDefaultParameters(): array
    {
        return [
            'testMode' => false,
        ];
    }


    /**
     * Set user
     *
     * @param string $value
     * @return Gateway
     */
    public function setSector(string $value): self
    {
        return $this->setParameter('user', $value);
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser(): string
    {
        return $this->getParameter('user');
    }

    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getEndPoint(): string
    {
        return $this->getParameter('endPoint');
    }

    /**
     * Set endpoint URL
     *
     * @param string $endPoint
     * @return $this
     */
    public function setEndPoint($endPoint): self
    {
        return $this->setParameter('endPoint', $endPoint);
    }

    /**
     * Get gateway password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    /**
     * Set gateway password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password): self
    {
        return $this->setParameter('password', $password);
    }

    /**
     * Get the request return URL
     *
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * Sets the request return URL
     *
     * @param string $value
     * @return $this
     */
    public function setReturnUrl($value): self
    {
        return $this->setParameter('returnUrl', $value);
    }

    /**
     * Request for order registration with pre-authorization
     *
     * @param array $options array of options
     * @return RequestInterface
     */
    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Order completion payment request
     *
     * @param array $options
     * @return RequestInterface
     */
    public function capture(array $options = []): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    /**
     * Refund order request
     *
     * @param array $options
     * @return RequestInterface
     */
    public function refund(array $options = []): RequestInterface
    {
        return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * Order status request
     *
     * @param array $options
     * @return RequestInterface
     */
    public function orderStatus(array $options = []): RequestInterface
    {
        return $this->createRequest(OrderStatusRequest::class, $options);
    }

    /**
     * @return bool
     */
    public function supportsOrderStatus(): bool
    {
        return method_exists($this, 'orderStatus');
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}
