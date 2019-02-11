<?php

use BunkerDB\TwitterAdsSDK\TwitterAds;
use BunkerDB\TwitterAdsSDK\TwitterAds\Account;
use BunkerDB\TwitterAdsSDK\TwitterAds\Analytics;
use BunkerDB\TwitterAdsSDK\TwitterAds\Campaign\Campaign;
use BunkerDB\TwitterAdsSDK\TwitterAds\Campaign\LineItem;
use BunkerDB\TwitterAdsSDK\TwitterAds\Enumerations;
use BunkerDB\TwitterAdsSDK\TwitterAds\Fields\AnalyticsFields;

require '../autoload.php';

const CONSUMER_KEY = 'your consumer key';
const CONSUMER_SECRET = 'your consumer secret';
const ACCESS_TOKEN = 'your access token';
const ACCESS_TOKEN_SECRET = 'your access token secret';
const ACCOUNT_ID = 'account id';

// Create Twitter Ads Api Instance
$api = TwitterAds::init(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

$accounts = $api->getAccounts();
// load up the account instance, campaign and line item
$account = new Account(ACCOUNT_ID);
$account->read();

$jobs = $account->getJobs();