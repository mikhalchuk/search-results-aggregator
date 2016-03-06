<?php
namespace SearchResultsAggregator\Engine\Yahoo;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;
use SearchResultsAggregator\Engine\EngineInterface;
use SearchResultsAggregator\Result\FactoryInterface;

class Search implements EngineInterface
{
    const ENGINE_NAME = 'Yahoo';

    const QUERY_MASK = 'https://search.yahoo.com/search?p=%s&fr2=sb-top-search&fr=yfp-t-201&fp=1';

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
        $request = new Request('GET', sprintf(self::QUERY_MASK, $keyword));
        $response = $this->httpClient->send($request);

        $results = Parser::parse((string)$response->getBody());

        return $this->resultsFactory->createResults(self::ENGINE_NAME, $results);
    }
}
