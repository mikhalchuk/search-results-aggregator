<?php
namespace SearchResultsAggregator\Tests;

use SearchResultsAggregator\Aggregator;
use SearchResultsAggregator\Result\Domain;
use SearchResultsAggregator\Engine\Yahoo\Search as YahooSearch;
use SearchResultsAggregator\Engine\Bing\Search as BingSearch;

class AggregatorTest extends \PHPUnit_Framework_TestCase
{
    public static function testAggregate()
    {
        $yahooResults = new \ArrayIterator();
        $yahooResults->append(new Domain(
            [
                'title' => 'High Power Laser Pointer - High power green laser pointers',
                'url' => 'www.laserpointerpro.com',
                'source' => [YahooSearch::ENGINE_NAME],
            ]
        ));
        $yahooResults->append(new Domain(
            [
                'title' => 'Pointer Brand Protection & Research | LinkedIn',
                'url' => 'www.linkedin.com',
                'source' => [YahooSearch::ENGINE_NAME],
            ]
        ));
        $yahooResults->append(new Domain(
            [
                'title' => 'QQ-Tech® Goggles Laser Eye Protection Safety Glasses Goggle ...',
                'url' => 'www.amazon.com',
                'source' => [YahooSearch::ENGINE_NAME],
            ]
        ));
        $bingResults = new \ArrayIterator();
        $bingResults->append(new Domain(
            [
                'title' => 'Pointer Brand Protection | Online Brand Protection Tool',
                'url' => 'pointerbp.com',
                'source' => [BingSearch::ENGINE_NAME],
            ]
        ));
        $bingResults->append(new Domain(
            [
                'title' => 'Pointer Brand Protection & Research | LinkedIn',
                'url' => 'www.linkedin.com',
                'source' => [BingSearch::ENGINE_NAME],
            ]
        ));

        $aggregatedResults = new \ArrayIterator();
        $aggregatedResults->append(new Domain(
            [
                'title' => 'High Power Laser Pointer - High power green laser pointers',
                'url' => 'www.laserpointerpro.com',
                'source' => [YahooSearch::ENGINE_NAME],
            ]
        ));
        $aggregatedResults->append(new Domain(
            [
                'title' => 'Pointer Brand Protection & Research | LinkedIn',
                'url' => 'www.linkedin.com',
                'source' => [YahooSearch::ENGINE_NAME, BingSearch::ENGINE_NAME],
            ]
        ));
        $aggregatedResults->append(new Domain(
            [
                'title' => 'QQ-Tech® Goggles Laser Eye Protection Safety Glasses Goggle ...',
                'url' => 'www.amazon.com',
                'source' => [YahooSearch::ENGINE_NAME],
            ]
        ));
        $aggregatedResults->append(new Domain(
            [
                'title' => 'Pointer Brand Protection | Online Brand Protection Tool',
                'url' => 'pointerbp.com',
                'source' => [BingSearch::ENGINE_NAME],
            ]
        ));

        self::assertEquals(
            $aggregatedResults,
            Aggregator::aggregate([$yahooResults, $bingResults])
        );
    }
}
