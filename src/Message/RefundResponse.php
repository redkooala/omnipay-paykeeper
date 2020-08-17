<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class RefundResponse
 * @package Omnipay\PayKeeper\Message
 */
class RefundResponse extends Response
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return isset($this->data['result']) && ($this->data['result'] === 'success');
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
       return $this->data['msg'] ?? null;
    }
}