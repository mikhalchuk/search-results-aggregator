<?php
namespace SearchResultsAggregator;

use SearchResultsAggregator\Result\Domain as ResultDomain;

class Aggregator
{
    /**
     * Aggregates search results and removes duplicates
     *
     * @param array $iterators
     * @return \ArrayIterator
     */
    public static function aggregate(array $iterators)
    {
        $collection = [];
        foreach ($iterators as $iterator) {
            /** @var ResultDomain $item */
            foreach ($iterator as $item) {
                $key = self::calculateHash($item);
                if (!empty($collection[$key])) {
                    /** @var ResultDomain $obj */
                    $obj = $collection[$key];
                    foreach ($item->getSource() as $source) {
                        $obj->addSource($source);
                    }
                } else {
                    $collection[$key] = $item;
                }
            }
        }

        return new \ArrayIterator(array_values($collection));
    }

    protected static function calculateHash(ResultDomain $object)
    {
        return md5(strtolower(sprintf('%s:%s', trim($object->getTitle()), trim($object->getUrl()))));
    }
}
