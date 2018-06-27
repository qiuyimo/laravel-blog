<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use Exception;

class ElasticsearchTestController extends Controller
{

    public function index()
    {
        $hosts = ['elasticsearch'];

        $client = ClientBuilder::create()->setHosts($hosts)->build();

        $params = [
            'index' => 'my_liming',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => '123213213c']
        ];

        try {
            $response = $client->index($params);
            dump($response);
        } catch (Exception $e) {
            dump($e->getMessage());
            $last = $client->transport->getLastConnection()->getLastRequestInfo();
            $last['response']['error'] = [];
            dump($last);
        }
    }
}
