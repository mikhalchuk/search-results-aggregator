<?php
namespace SearchResultsAggregator\Result;

class Factory implements FactoryInterface
{
    public function createResults($source, array $collection)
    {
        $iterator = new \ArrayIterator();

        foreach ($collection as $item) {
            $item['source'] = [$source];
            $iterator->append(new Domain($item));
        }

        return $iterator;
    }
}
