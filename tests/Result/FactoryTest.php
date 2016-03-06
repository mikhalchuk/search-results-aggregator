<?php
namespace SearchResultsAggregator\Tests\Result;

use SearchResultsAggregator\Result\Domain;
use SearchResultsAggregator\Result\Factory;
use SearchResultsAggregator\Engine\Bing\Search;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public static function testFactoryCreate()
    {
        $result = [
            [
                'title' => 'Pointer Brand Protection | Online Brand Protection Tool',
                'url' => 'pointerbp.com',
            ],
            [
                'title' => 'Pointer Brand Protection & Research | LinkedIn',
                'url' => 'www.linkedin.com',
            ],
            [
                'title' => 'Pointer Brand Protection, anti-piracy service provider ...',
                'url' => 'pointerbp.com'
            ],
            [
                'title' => 'Brand protection - SlideShare',
                'url' => 'www.slideshare.net',
            ],
            [
                'title' => 'Reviews of Pointer BP : Free Pricing & Demos : Brand ...',
                'url' => 'www.capterra.com',
            ],
            [
                'title' => 'IPPro The Internet | Service providers | Pointer Brand ...',
                'url' => 'www.ipprotheinternet.com',
            ],
            [
                'title' => 'About pointer brand protection leading expert in …',
                'url' => 'www.slideshare.net',
            ],
            [
                'title' => 'Contributors - Online Brand Enforcement 2015 - World ...',
                'url' => 'www.worldtrademarkreview.com',
            ],
            [
                'title' => 'Global Brand Protection',
                'url' => 'www.globalbrandprotection.net',
            ],
        ];

        $iterator = new \ArrayIterator();
        foreach ($result as $item) {
            $item['source'] = [Search::ENGINE_NAME];
            $iterator->append(new Domain($item));
        }

        self::assertEquals(
            (new Factory())->createResults(Search::ENGINE_NAME, $result),
            $iterator
        );
    }
}
