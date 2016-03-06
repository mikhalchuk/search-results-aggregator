<?php
namespace SearchResultsAggregator\Tests\Engine\Bing;

use SearchResultsAggregator\Engine\Bing\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public static function testSuccessParse()
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
        $html = file_get_contents(realpath(__DIR__) . '/results.html');

        self::assertEquals(
            $result,
            Parser::parse($html)
        );
    }
}
