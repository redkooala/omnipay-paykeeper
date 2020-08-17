<?php

namespace Omnipay\Paykeeper\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\PayKeeper\Exception\EmptyResponseException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class AbstractRequest
 * @package Omnipay\Paykeeper\Message
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Method name from bank API
     *
     * @return string
     */
    abstract public function getAction(): string;


    /**
     * Get endpoint URL
     *
     * @return string
     */
    public function getEndPoint(): string
    {
        return $this->getParameter('endPoint');
    }

    /**
     * Set endpoint URL
     *
     * @param string $endPoint
     * @return $this
     */
    public function setEndPoint(string $endPoint): self
    {
        return $this->setParameter('endPoint', $endPoint);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getParameter('password');
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        return $this->setParameter('password', $password);
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->getParameter('user');
    }

    /**
     * @param string user
     * @return $this
     */
    public function setUser(string $user): self
    {
        return $this->setParameter('user', $user);
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->getParameter('lang');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setLanguage(string $value): self
    {
        return $this->setParameter('lang', $value);
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * Get Request headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        if (!($user = $this->getUser()) || !$password = $this->getPassword()) {
            throw new \RuntimeException('invalid auth data');
        }

        return [
            "content-type" => 'application/x-www-form-urlencoded',
            "Authorization" => "Basic " . base64_encode("$user:$password"),
        ];
    }

    /**
     * @inheritdoc
     *
     * @param mixed $data
     * @return object|\Omnipay\Common\Message\ResponseInterface
     * @throws \ReflectionException
     * @throws InvalidResponseException
     */
    public function sendData($data): ResponseInterface
    {
        $url = $this->getUrl();
        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $url,
            $this->getHeaders(),
            http_build_query($data, '', '&')
        );


        if ($httpResponse->getStatusCode() == 401) {
            throw new UnauthorizedHttpException('authorize fail');
        }

        if (($status = $httpResponse->getStatusCode()) !== 200) {
            throw new BadRequestHttpException('invalid response status:' . $status);
        }

        $responseClassName = str_replace(
            'Request',
            'Response',
            \get_class($this)
        );

        $reflection = new \ReflectionClass($responseClassName);
        if (!$reflection->isInstantiable()) {
            throw new RuntimeException(
                'Class ' . str_replace('Request', 'Response', \get_class($this)) . ' not found'
            );
        }

        $result = json_decode($httpResponse->getBody()->getContents(), true);
        if (!$result) {
            throw new EmptyResponseException('empty response');
        }

        return $reflection->newInstance($this, $result, true);
    }

    /**
     *
     * @return string
     */
    protected function getUrl(): string
    {
        return  $this->getEndPoint() . $this->getAction();
    }

    /**
     * Add additional params to data
     *
     * @param array $data
     * @param array $additionalParams
     * @return array
     */
    public function specifyAdditionalParameters(array $data, array $additionalParams): array
    {
        foreach ($additionalParams as $param) {
            $method = 'get' . ucfirst($param);
            if (method_exists($this, $method)) {
                $value = $this->{$method}();
                if ($value) {
                    $data[$param] = $value;
                }
            }
        }
        return $data;
    }
}
