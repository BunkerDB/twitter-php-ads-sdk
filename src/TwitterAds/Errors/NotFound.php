<?php

namespace BunkerDB\TwitterAdsSDK\TwitterAds\Errors;

use Exception;
use BunkerDB\TwitterAdsSDK\TwitterAdsException;

class NotFound extends TwitterAdsException
{
    public function __construct($message, $code, Exception $previous = null, $errors)
    {
        parent::__construct($message, $code, null, $errors);
    }
}
