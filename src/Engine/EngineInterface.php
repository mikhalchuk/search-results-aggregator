<?php
namespace SearchResultsAggregator\Engine;

interface EngineInterface
{
    /**
     * Collect results from engine by given keyword
     *
     * @param string $keyword
     * @return \ArrayIterator
     */
    public function collect($keyword);
}
