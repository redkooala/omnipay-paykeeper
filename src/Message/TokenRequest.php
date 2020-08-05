<?php

namespace Omnipay\PayKeeper\Message;

class TokenRequest extends AbstractRequest
{
    /**
     * Method name from bank API
     *
     * @return string
     */
    public function getAction(): string
    {
        return '/info/settings/token/';
    }

    public function getData()
    {
        return [];
    }
}