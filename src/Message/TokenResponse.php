<?php

namespace Omnipay\PayKeeper\Message;


class TokenResponse extends Response
{
    public function isSuccessful(): bool
    {
        return (bool)$this->data['token'];
    }
}