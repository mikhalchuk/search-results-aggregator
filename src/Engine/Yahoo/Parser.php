<?php
namespace SearchResultsAggregator\Engine\Yahoo;

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

        $texts = $crawler->filterXPath('//*[@id="main"]/*//div[contains(@class, "compTitle ")]')->each(
            function (Crawler $node, $i) {
                $children = $node->children();
                $first = $children->first();
                $last = $children->last();
                if ($first->nodeName() !== 'h3') {
                    return null;
                }

                return [
                    'title' => trim($first->text()),
                    'url' => trim(explode('/', $last->text())[0])
                ];
            }
        );

        return array_values(array_filter($texts));
    }
}
