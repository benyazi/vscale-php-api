<?php
namespace Benyazi\VscaleApi;

class Client
{
    const ENDPOINT = 'https://api.vscale.io/{VERSION}/';
    private $apiKey;
    private $version;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $version
     */
    public function __construct($apiKey, $version = 'v1')
    {
        $this->apiKey = $apiKey;
        $this->version = $version;
    }

    /**
     * @return string
     */
    private function getEndpoint()
    {
        return str_replace('{VERSION}', $this->version, self::ENDPOINT);
    }

    /**
     * @param string $method
     * @return array
     */
    private function getRequest($method)
    {
        $url = $this->getEndpoint() . $method;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Token: ' . $this->apiKey
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    /**
     * @param string $method
     * @param array $params
     * @return array
     */
    private function postRequest($method, $params = [])
    {
        $url = $this->getEndpoint() . $method;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-Token: ' . $this->apiKey
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    /**
     * Get list of scalets
     * @return array
     */
    public function getScalets()
    {
        return $this->getRequest('scalets');
    }

    /**
     * Get current balance
     * @return array
     */
    public function getBillingBalance()
    {
        return $this->getRequest('billing/balance');
    }

    /**
     * Get billing prices
     * @return array
     */
    public function getBillingPrices()
    {
        return $this->getRequest('billing/prices');
    }
}