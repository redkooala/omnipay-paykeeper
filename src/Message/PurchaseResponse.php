<?php

namespace Omnipay\Paykeeper\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class AuthorizeResponse
 * @package Omnipay\PayKeeper\Message
 */
class PurchaseResponse extends Response implements RedirectResponseInterface
{
    /**
     * @inheritdoc
     */
    public function isRedirect(): bool
    {
        return $this->isSuccessful();
    }

    /**
     * @inheritdoc
     */
    public function getRedirectUrl(): ?string
    {
        return $this->getRequest()->getEndPoint() . 'bill/' . $this->data['invoice_id'];
    }

    /**
     * @inheritdoc
     */
    public function getRedirectData(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
       return $this->data;
    }

}
