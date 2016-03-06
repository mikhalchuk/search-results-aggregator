<?php
namespace SearchResultsAggregator\Tests\Engine\Yahoo;

use SearchResultsAggregator\Engine\Yahoo\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public static function testSuccessParse()
    {
        $result = [
            [
                'title' => 'High Power Laser Pointer - High power green laser pointers',
                'url' => 'www.laserpointerpro.com',
            ],
            [
                'title' => 'Pointer Brand Protection | Online Brand Protection Tool',
                'url' => 'pointerbp.com',
            ],
            [
                'title' => 'Pointer Brand Protection, anti-piracy service...',
                'url' => 'pointerbp.com'
            ],
            [
                'title' => 'Pointer Brand Protection & Research | LinkedIn',
                'url' => 'www.linkedin.com',
            ],
            [
                'title' => 'Hunting Bib Overalls / Pointer Brand Bibs -- Orvis',
                'url' => 'www.orvis.com',
            ],
            [
                'title' => 'Reviews of Pointer BP : Free Pricing & Demos : Brand ...',
                'url' => 'www.capterra.com',
            ],
            [
                'title' => 'IPPro The Internet | Service providers | Pointer ...',
                'url' => 'www.ipprotheinternet.com',
            ],
            [
                'title' => 'About pointer brand protection leading expert in online brand ...',
                'url' => 'www.slideshare.net',
            ],
            [
                'title' => 'Online Brand Protection - 6 steps to shutdown a rogue webshop ...',
                'url' => 'www.slideshare.net',
            ],
            [
                'title' => 'Jay van Boxtel | LinkedIn',
                'url' => 'www.linkedin.com',
            ],
            [
                'title' => 'QQ-Tech® Goggles Laser Eye Protection Safety Glasses Goggle ...',
                'url' => 'www.amazon.com',
            ],
            [
                'title' => 'Also try',
                'url' => 'Also try',
            ]
        ];
        $html = file_get_contents(realpath(__DIR__) . '/results.html');

        self::assertEquals(
            $result,
            Parser::parse($html)
        );
    }
}
