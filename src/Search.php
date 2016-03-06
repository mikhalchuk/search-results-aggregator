<?php
namespace SearchResultsAggregator;

use SearchResultsAggregator\Engine\EngineInterface;

class Search
{
    protected $engines = [];

    public function __construct(array $engines = [])
    {
        $this->engines = $engines;
    }

    public function pushEngine(EngineInterface $engine)
    {
        $this->engines[] = $engine;
    }

    /**
     * @param string $keyword
     * @return \ArrayIterator
     */
    public function search($keyword)
    {
        if (!is_string($keyword)) {
            throw new \InvalidArgumentException(
                sprintf('Keyword argument should be string, %s given', gettype($keyword))
            );
        }

        $results = [];
        /** @var EngineInterface $engine */
        foreach ($this->engines as $engine) {
            $results[] = $engine->collect($keyword);
        }

        return Aggregator::aggregate($results);
    }
}
