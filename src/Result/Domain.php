<?php
namespace SearchResultsAggregator\Result;

class Domain
{
    protected $title;

    protected $url;

    protected $source = [];

    public function __construct(array $attributes = [])
    {
        $this->title = !empty($attributes['title']) ? $attributes['title'] : '';
        $this->url = !empty($attributes['url']) ? $attributes['url'] : '';
        $this->source = !empty($attributes['source']) ? $attributes['source'] : [];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getSource()
    {
        return $this->source;
    }

    public function addSource($source)
    {
        $this->source[] = $source;
    }
}
