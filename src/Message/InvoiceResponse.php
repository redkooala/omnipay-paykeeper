<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class OrderStatusResponse
 * @package Omnipay\PayKeeper\Message
 */
class InvoiceResponse extends Response
{
    public function isSuccessful(): bool
    {
        return isset($this->data['id']);
    }

    public function getMessage(): ?string
    {
        $message = null;
        if (isset($this->data['result']) && $this->data['result'] === 'fail') {
            $message = $this->data['msg'] ?? null;
        }

        return $message;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->data['status'];
    }

    public function getPayment(): ?int
    {
        return $this->data['paymentid'] ?? null;
    }
}
