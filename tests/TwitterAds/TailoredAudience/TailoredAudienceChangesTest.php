<?php

use BunkerDB\TwitterAdsSDK\TwitterAds;
use BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudience;
use BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudienceChanges;
use BunkerDB\TwitterAdsSDK\TwitterAds\Campaign\Campaign;
use BunkerDB\TwitterAdsSDK\TwitterAds\Cursor;
use PHPUnit\Framework\TestCase;

class TailoredAudienceChangesTest extends TestCase
{
    /** @var TwitterAds */
    protected $twitter;

    /**
     * @expectedException BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\Exception\InvalidOperation
     */
    public function testTailoredAudienceChangesWillThrowAnExceptionWithAnInvalidOperation()
    {
        $audience = new TailoredAudienceChanges(null);
        $audience->setOperation('nope');
    }

    public function testTailoredAudienceChangesCanBeFetchedAndUpdated()
    {
        $this->markTestSkipped('waiting for write access to twitter ads api');
        $accounts = $this->twitter->getAccounts();
        $this->assertGreaterThan(0, count($accounts));

        $account = iterator_to_array($accounts)[0];
        $audience = new TailoredAudience($account);
        $audience->setListType(TailoredAudience::LIST_TYPE_EMAIL);
        $audience->save();
    }

    protected function setUp()
    {
        $this->twitter = new TwitterAds(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET, false);
    }
}
