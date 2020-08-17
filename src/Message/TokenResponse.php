<?php

namespace Omnipay\PayKeeper\Message;


use Omnipay\Common\Message\RequestInterface;

class TokenResponse extends Response
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
    }

    public function isSuccessful(): bool
    {
        return isset($this->data['token']) && (bool)$this->data['token'];
    }

    public function getToken(): ?string
    {
        return $this->data['token'] ?? null;
    }
}