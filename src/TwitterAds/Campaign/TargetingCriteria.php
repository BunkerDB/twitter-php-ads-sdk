<?php

namespace BunkerDB\TwitterAdsSDK\TwitterAds\Campaign;

use BunkerDB\TwitterAdsSDK\TwitterAds\Cursor;
use BunkerDB\TwitterAdsSDK\TwitterAds\Errors\MethodNotAllowedException;
use BunkerDB\TwitterAdsSDK\TwitterAds\Fields\TargetingCriteriaFields;
use BunkerDB\TwitterAdsSDK\TwitterAds\Resource;

class TargetingCriteria extends Resource
{
    const RESOURCE_COLLECTION = 'accounts/{account_id}/targeting_criteria';
    const RESOURCE            = 'accounts/{account_id}/targeting_criteria/{id}';

    /** Read Only */
    protected $id;
    protected $localized_name;
    protected $name;
    protected $created_at;
    protected $updated_at;
    protected $deleted;

    protected $properties = [
        TargetingCriteriaFields::LINE_ITEM_ID,
        TargetingCriteriaFields::TARGETING_TYPE,
        TargetingCriteriaFields::TARGETING_VALUE,
        TargetingCriteriaFields::TAILORED_AUDIENCE_EXPANSION,
        TargetingCriteriaFields::TAILORED_AUDIENCE_TYPE,
    ];

    protected $line_item_id;
    protected $targeting_type;
    protected $targeting_value;
    protected $tailored_audience_expansion;
    protected $tailored_audience_type;

    /**
     * @param $line_item_id
     * @param array $params
     *
     * @return Cursor
     */
    public function line_item_all($line_item_id, $params = [])
    {
        $params[TargetingCriteriaFields::LINE_ITEM_ID] = $line_item_id;

        $resource = str_replace(static::RESOURCE_REPLACE, $this->getTwitterAds()->getAccountId(), static::RESOURCE_COLLECTION);
        $request = $this->getTwitterAds()->get($resource, $params);

        return new Cursor($this, $this->getTwitterAds(), $request->getBody(), $params);
    }

    
    public function save()
    {
        if ($this->getId()) {
            throw new MethodNotAllowedException();
        } else {
            return parent::save();
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLocalizedName()
    {
        return $this->localized_name;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
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
    public function getLineItemId()
    {
        return $this->line_item_id;
    }

    /**
     * @return mixed
     */
    public function getTargetingType()
    {
        return $this->targeting_type;
    }

    /**
     * @return mixed
     */
    public function getTargetingValue()
    {
        return $this->targeting_value;
    }

    /**
     * @return mixed
     */
    public function getTailoredAudienceExpansion()
    {
        return $this->tailored_audience_expansion;
    }

    /**
     * @return mixed
     */
    public function getTailoredAudienceType()
    {
        return $this->tailored_audience_type;
    }

    /**
     * @param array $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param mixed $line_item_id
     */
    public function setLineItemId($line_item_id)
    {
        $this->line_item_id = $line_item_id;
    }

    /**
     * @param mixed $targeting_type
     */
    public function setTargetingType($targeting_type)
    {
        $this->targeting_type = $targeting_type;
    }

    /**
     * @param mixed $targeting_value
     */
    public function setTargetingValue($targeting_value)
    {
        $this->targeting_value = $targeting_value;
    }

    /**
     * @param mixed $tailored_audience_expansion
     */
    public function setTailoredAudienceExpansion($tailored_audience_expansion)
    {
        $this->tailored_audience_expansion = $tailored_audience_expansion;
    }

    /**
     * @param mixed $tailored_audience_type
     */
    public function setTailoredAudienceType($tailored_audience_type)
    {
        $this->tailored_audience_type = $tailored_audience_type;
    }
}
