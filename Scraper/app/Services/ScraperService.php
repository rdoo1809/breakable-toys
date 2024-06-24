<?php

namespace App\Services;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Http\JsonResponse;

class ScraperService
{
    public function scrape(): JsonResponse
    {
        $client = new HttpBrowser();
        $arrayOfQuotes = [];

        $website = $client->request('GET', 'https://quotes.toscrape.com/')
            ->filter('div.quote')
            ->each(function ($node) use (&$arrayOfQuotes) {
                $quoteText = $node->filter('.text')->text();
                $author = $node->filter('.author')->text();
                $tags = $node->filter('.tags a')->each(function ($tagNode) {
                    return $tagNode->text();
                });

                $obj = [
                    'quote' => $quoteText,
                    'author' => $author,
                    'tags' => $tags
                ];
                $arrayOfQuotes[] = $obj; //$node->text();
            });
        return new JsonResponse($arrayOfQuotes);
    }


    public function browse(): JsonResponse
    {
        $client = new HttpBrowser();
        $query = "quotes from famous people";
        $url = 'https://www.google.com/search?q=' . urlencode($query);
        $searchResults = [];

        $headers = [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
        ];

        $response = $client->request('GET', $url, ["headers" => $headers])
            ->filter('div')
//            ->filter('div.yuRYbf > div > span > a')
            //->filter('div.yuRUbf')
            //->filterXPath('//*[@id="rso"]/div[9]/div/div/div[1]/div/div/span/a/div/div/div/div[2]/cite/text()')
            ->each(function ($node) use (&$searchResults) {
                $text = $node->text();
                //$href = $node->attr('href');
                //$searchResults[] = $node->attr('href');
                $searchResults[] = $text;
            });


        return new JsonResponse($searchResults);
    }
}

