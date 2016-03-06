<?php

require_once './vendor/autoload.php';

use SearchResultsAggregator\Search;
use SearchResultsAggregator\Result\Factory as ResultFactory;
use SearchResultsAggregator\Engine\Bing\Search as BingSearch;
use SearchResultsAggregator\Engine\Yahoo\Search as YahooSearch;

const KEYWORD = 'Pointer Brand Protection';

$search = new Search();

$factoryResult = new ResultFactory();

$headers = [
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Cache-Control' => 'max-age=0',
    'Connection' => 'keep-alive',
    'Accept-Language' => 'en-GB,en;q=0.8,uk;q=0.6,en-US',
    'User-Agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:35.0) Gecko/20100101 Firefox/35.0',
];
$httpClient = new GuzzleHttp\Client(['headers' => $headers]);

$bingEngine = new BingSearch($httpClient, $factoryResult);
$yahooEngine = new YahooSearch($httpClient, $factoryResult);

$search->pushEngine($bingEngine);
$search->pushEngine($yahooEngine);

$aggregatedResult = $search->search(KEYWORD);

/** @var \SearchResultsAggregator\Result\Domain $item */
foreach ($aggregatedResult as $item) {
    printf('%s(%s) in %s%s', $item->getTitle(), $item->getUrl(), implode(' + ', $item->getSource()), PHP_EOL);
}
