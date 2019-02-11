<?php

namespace BunkerDB\TwitterAdsSDK\TwitterAds\Errors;

use Exception;
use BunkerDB\TwitterAdsSDK\TwitterAdsException;

class ServiceUnavailable extends TwitterAdsException
{
    private $retryAfter;

    public function __construct($message, $code, Exception $previous = null, $errors, $headers)
    {
        parent::__construct($message, $code, null, $errors);
        $this->retryAfter = $headers['retry-after'];
    }

    /**
     * @return mixed
     */
    public function getRetryAfter()
    {
        return $this->retryAfter;
    }
}
