<?php
namespace SearchResultsAggregator\Engine\Bing;

use Symfony\Component\DomCrawler\Crawler;

class Parser
{
    /**
     * @param string $html
     * @return array
     */
    public static function parse($html)
    {
        $crawler = new Crawler($html);

        return $crawler->filterXPath('//*[@id="b_results"]/li[*]/h2/a')->each(
            function (Crawler $node, $i) {
                return [
                    'title' => trim($node->text()),
                    'url' => parse_url(trim($node->attr('href')), PHP_URL_HOST)
                ];
            }
        );
    }
}
