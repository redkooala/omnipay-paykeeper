<?php

namespace Omnipay\PayKeeper\Message;

/**
 * Class OptionResponse
 * @package Omnipay\PayKeeper\Message
 */
class OptionResponse extends Response
{
    public function isSuccessful(): bool
    {
        return isset($this->data['CARD_NUMBER']);
    }


    public function getMessage(): ?string
    {
        if (!$this->isSuccessful()) {
            return 'not enought CARD_NUMBER';
        }

        return parent::getMessage();
    }

    public function getCardNumber(): ?string
    {
        return $this->data['CARD_NUMBER'];
    }
}
