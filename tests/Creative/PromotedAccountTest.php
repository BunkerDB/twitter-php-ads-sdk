<?php
use BunkerDB\TwitterAdsSDK\TwitterAds;
use BunkerDB\TwitterAdsSDK\TwitterAds\Account;

/**
 * Created by PhpStorm.
 * User: BunkerDB
 * Date: 17/04/16
 * Time: 22:38
 */
class PromotedAccountTest
{
    /** @var TwitterAds */
    protected $twitter;
    /** @var  Account */
    protected $account;

    /**
     * Set up the client
     */
    protected function setUp()
    {
        $this->twitter = new TwitterAds(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET, false);
        $this->account = $this->twitter->getAccounts()->next();
    }
}