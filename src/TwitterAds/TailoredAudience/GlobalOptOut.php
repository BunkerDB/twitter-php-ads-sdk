<?php

namespace BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience;

use BunkerDB\TwitterAdsSDK\TwitterAds;
use BunkerDB\TwitterAdsSDK\TwitterAds\Resource;
use BunkerDB\TwitterAdsSDK\TwitterAds\TailoredAudience\Exception\InvalidType;
use BunkerDB\TwitterAdsSDK\Arrayable;

/**
 * Updates a list of user's optout status
 *
 * @since 2016-06-27
 */
final class GlobalOptOut extends Resource
{
    const RESOURCE = 'accounts/{account_id}/tailored_audiences/{route}';

    // This is a hack to allow PUT requests for an entity without an ID
    const RESOURCE_ID_REPLACE = '{route}';
    const ROUTE               = 'global_opt_out';

    protected $input_file_path;
    protected $list_type;

    protected $properties = [
        'input_file_path',
        'list_type',
    ];

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return self::ROUTE;
    }

    public function getInputFilePath()
    {
        return $this->input_file_path;
    }

    public function setInputFilePath($path)
    {
        $this->input_file_path = $path;
    }

    /**
     * @return mixed
     */
    public function getListType()
    {
        return $this->assureValidType($this->list_type);
    }

    /**
     * @param string $type
     */
    public function setListType($type)
    {
        $this->list_type = $this->assureValidType($type);
    }

    /**
     * Asserts that the given type is valid
     *
     * @param string $type
     * @throws InvalidType - if type is invalid or null
     *
     * @return string
     */
    private function assureValidType($type)
    {
        foreach (TailoredAudience::getTypes() as $allowedType) {
            if ($type === $allowedType) {
                return $type;
            }
        }

        throw new InvalidType(
            sprintf('"%s" is not a valid type for %s', $type, TailoredAudience::class)
        );
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
