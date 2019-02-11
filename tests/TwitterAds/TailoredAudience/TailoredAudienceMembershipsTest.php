<?php

use BunkerDB\TwitterAdsSDK\TwitterAds;
use BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudienceMemberships;
use BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudienceMember;
use BunkerDB\TwitterAdsSDK\TwitterAds\Account;
use PHPUnit\Framework\TestCase;

class TailoredAudienceMembershipsTest extends TestCase
{
    /**
     * @expectedException BunkerDB\TwitterAdsSDK\TwitterAds\Errors\BatchLimitExceeded
     */
    public function testBatchWillThrowExceptionWhenTooManyMembersAreAdded()
    {
        $batch = new TailoredAudienceMemberships();

        for ($i = 0; $i < 101; $i++) {
            $member = new TailoredAudienceMember();
            $member->setScore($i);
            $batch->add($member);
        }
    }

    public function testBatchParametersAndUrlAreSetCorrectlyForRequest()
    {

        $this->markTestSkipped("Not prepared");
        $twitterAds = $this->getMockBuilder(TwitterAds::class)
            ->disableOriginalConstructor()
            ->getMock();

        $url = 'tailored_audience_memberships';

        $batch = new TailoredAudienceMemberships();
        for ($i = 0; $i < 10; $i++) {
            $member = new TailoredAudienceMember();
            $member->setScore($i);
            $batch->add($member);
        }

        $data = (object)['data' => (object)[]];
        $twitterAds->expects($this->once())
            ->method('post')
            ->with($url, ['operation_type' => TailoredAudienceMemberships::OPERATION, 'params' => $batch->toParams()])
            ->willReturn($data);

        $batch->save();
    }
}
