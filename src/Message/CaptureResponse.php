<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class CaptureResponse
 * @package Omnipay\PayKeeper\Message
 */
class CaptureResponse extends Response
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
