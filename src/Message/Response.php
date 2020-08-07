<?php

namespace Omnipay\PayKeeper\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Response
 * @package Omnipay\PayKeeper\Message
 */
class Response extends AbstractResponse
{
    /**
     * {@inheritdoc}
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): ?int
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return false;
    }
}