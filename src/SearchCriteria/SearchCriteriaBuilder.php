<?php

namespace Acquia\ContentHubClient\SearchCriteria;

/**
 * Class SearchCriteriaBuilder
 *
 * @package Drupal\acquia_contenthub\Client
 */
class SearchCriteriaBuilder
{

    /**
     * SearchCriteriaBuilder constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Creates search-criteria instance from array.
     *
     * @param array $data
     *
     * @return \Acquia\ContentHubClient\SearchCriteria\SearchCriteria
     */
    public static function createFromArray(array $data)
    {
        return new SearchCriteria(
            self::extractPropertyFromArray('search_term', $data, SearchCriteria::DEFAULT_SEARCH_TERM),
            self::extractPropertyFromArray('type', $data, []),
            self::extractPropertyFromArray('bundle', $data, []),
            self::extractPropertyFromArray('tags', $data, []),
            self::extractPropertyFromArray('label', $data, ''),
            self::extractPropertyFromArray('start_date', $data, null),
            self::extractPropertyFromArray('end_date', $data, null),
            self::extractPropertyFromArray('from', $data, SearchCriteria::DEFAULT_OFFSET),
            self::extractPropertyFromArray('size', $data, SearchCriteria::DEFAULT_LIMIT),
            self::extractPropertyFromArray('sorting', $data, ''),
            self::extractPropertyFromArray('version', $data, SearchCriteria::DEFAULT_VERSION)
        );
    }

    /**
     * Map contains possible properties aliases.
     *
     * @return array
     *   Map of aliases
     */
    protected static function propertiesMap()
    {
        return [
          'search_term' => ['search_term'],
          'type' => ['type'],
          'bundle' => ['bundle'],
          'tags' => ['tags'],
          'label' => ['label'],
          'start_date' => ['start_date'],
          'end_date' => ['end_date'],
          'from' => ['from', 'start'],
          'size' => ['size', 'limit'],
          'sorting' => ['sort'],
          'version' => ['version'],
        ];
    }

    /**
     * Extracts property value.
     *
     * @param string $propertyName
     * @param array $data
     * @param string $default
     *
     * @return array|mixed|string
     */
    protected static function extractPropertyFromArray(string $propertyName, array $data, $default = '')
    {
        $map = self::propertiesMap();
        if (!isset($map[$propertyName])) {
            return $default;
        }

        $values = array_values(array_intersect($map[$propertyName], array_keys($data)));
        if (empty($values[0])) {
            return $default;
        }

        $key = $values[0];

        return is_array($default) ? [$data[$key]] : $data[$key];
    }
}
