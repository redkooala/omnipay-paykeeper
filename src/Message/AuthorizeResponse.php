<?php

namespace Omnipay\PayKeeper\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class AuthorizeResponse
 * @package Omnipay\PayKeeper\Message
 */
class AuthorizeResponse extends Response implements RedirectResponseInterface
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
        return $this->getRequest()->getEndPoint() . '/bill/' . $this->data['invoice_id'];
    }

    /**
     * @return array
     */
    public function getRedirectData(): array
    {
        return [];
    }

    public function isSuccessful(): bool
    {
        return isset($this->data['invoice_id']) && (bool)$this->data['invoice_id'];
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    /**
     * @inheriDoc
     */
    public function getData()
    {
       return $this->data;
    }

    /**
     * @return int
     */
    public function getInvoiceId(): int {
        return $this->data['invoice_id'];
    }
}
