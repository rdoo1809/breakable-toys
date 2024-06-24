<?php

namespace App\Http\Controllers;

use App\Services\ScraperService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\BrowserKit\HttpBrowser;

class ScraperController extends Controller
{
    protected ScraperService $scraperService;

    public function __construct(ScraperService $scraperService){
        $this->scraperService = $scraperService;
    }

    public function index()//: JsonResponse
    {
        //$data = $this->scraperService->scrape();
        $data = $this->scraperService->scrape();
        $data = json_decode($data->getContent(), true);

        //return $this->scraperService->scrape();
        return view('scraper', ['data' => $data]);
    }

    public function rawData(): JsonResponse
    {
        return $this->scraperService->scrape();

    }

    public function getSites(): JsonResponse
    {
        return $this->scraperService->browse();
    }
}
