<?php

namespace BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience;

use BunkerDB\TwitterAdsSDK\TwitterAds;
use BunkerDB\TwitterAdsSDK\TwitterAds\Cursor;
use BunkerDB\TwitterAdsSDK\TwitterAds\Resource;
use BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\Exception\InvalidOperation;

/**
 * Represents a Tailored Audience Change object
 * Supports: GET, POST
 *
 * @since 2016-06-27
 */
final class TailoredAudienceChanges extends Resource
{
    const RESOURCE_COLLECTION = 'accounts/{account_id}/tailored_audience_changes';
    const RESOURCE            = 'accounts/{account_id}/tailored_audience_changes/{id}';

    const ADD     = 'ADD';
    const REMOVE  = 'REMOVE';
    const REPLACE = 'REPLACE';

    protected $input_file_path;
    protected $tailored_audience_id;
    protected $operation;

    protected $properties = [
        'tailored_audience_id',
        'input_file_path',
        'operation',
    ];

    /** Read Only */
    protected $id;
    protected $state;

    public function updateAudience($tailoredAudienceId, $location, $listType, $operation)
    {
        $params = [
            'tailored_audience_id' => $tailoredAudienceId,
            'input_file_path' => $location,
            'list_type' => $listType,
            'operation' => $operation
        ];

        $resource = str_replace(static::RESOURCE_REPLACE, $this->getTwitterAds()->getAccountId(), TailoredAudienceChanges::RESOURCE_COLLECTION);

        return $this->getTwitterAds()->post($resource, $params);
    }

    public function status($tailoredAudienceId)
    {
        $resource = str_replace(static::RESOURCE_REPLACE, $this->getTwitterAds()->getAccountId(), TailoredAudienceChanges::RESOURCE_COLLECTION);
        $response = $this->getTwitterAds()->get($resource, []);

        $tailoredAudienceChanges = new Cursor($this, $this->getTwitterAds(), $response->getBody(), []);

        foreach ($tailoredAudienceChanges as $tailoredAudienceChange) {
            if ($tailoredAudienceChange->getTailoredAudienceId() == $tailoredAudienceId) {
                return $tailoredAudienceChange;
            }
        }
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInputFilePath()
    {
        return $this->input_file_path;
    }

    public function setInputFilePath($path)
    {
        $this->input_file_path = $path;
    }

    public function getTailoredAudienceId()
    {
        return $this->tailored_audience_id;
    }

    public function setTailoredAudienceId($id)
    {
        $this->tailored_audience_id = $id;
    }

    public function getOperation()
    {
        return $this->assureValidOperation($this->operation);
    }

    public function setOperation($op)
    {
        $this->operation = $this->assureValidOperation($op);
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    private function getOperations()
    {
        return [
            self::ADD,
            self::REMOVE,
            self::REPLACE,
        ];
    }

    private function assureValidOperation($op)
    {
        foreach ($this->getOperations() as $allowedOp) {
            if ($op === $allowedOp) {
                return $op;
            }
        }

        throw new InvalidOperation(
            sprintf('"%s" is not a valid operation for %s', $op, TailoredAudience::class)
        );
    }
}
