<?php

namespace BunkerDB\TwitterAdsSDK\TwitterAds\Errors;

use Exception;
use BunkerDB\TwitterAdsSDK\TwitterAdsException;

class NotAuthorized extends TwitterAdsException
{
    public function __construct($message, $code, Exception $previous = null, $errors)
    {
        parent::__construct($message, $code, null, $errors);
    }
}
