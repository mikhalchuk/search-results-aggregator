<?php
namespace SearchResultsAggregator\Result;

interface FactoryInterface
{
    /**
     * Creates result domains
     *
     * @param string $source
     * @param array $collection
     * @return \ArrayIterator[Domain]
     */
    public function createResults($source, array $collection);
}
