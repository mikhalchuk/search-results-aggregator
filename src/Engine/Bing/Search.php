<?php
namespace SearchResultsAggregator\Engine\Bing;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;
use SearchResultsAggregator\Engine\EngineInterface;
use SearchResultsAggregator\Result\FactoryInterface;

class Search implements EngineInterface
{
    const ENGINE_NAME = 'Bing';

    const QUERY_MASK = 'http://www.bing.com/search?q=%s&go=Submit&qs=n&form=QBLH&pq=%s
                        &sc=8-7&sp=-1&sk=&cvid=66415013DEE2406687DB4D8EC3BB078A';

    /**
     * @var ClientInterface $httpClient
     */
    protected $httpClient;

    /**
     * @var FactoryInterface
     */
    protected $resultsFactory;

    public function __construct(ClientInterface $client, FactoryInterface $resultsFactory)
    {
        $this->httpClient = $client;
        $this->resultsFactory = $resultsFactory;
    }

    public function collect($keyword)
    {
        $request = new Request('GET', sprintf(self::QUERY_MASK, $keyword, $keyword));
        $response = $this->httpClient->send($request);

        $results = Parser::parse((string)$response->getBody());

        return $this->resultsFactory->createResults(self::ENGINE_NAME, $results);
    }
}
