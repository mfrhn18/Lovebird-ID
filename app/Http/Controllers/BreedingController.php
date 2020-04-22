<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class BreedingController extends Controller
{
    public function index()
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{
                    user{
                        birdParent{
                            id noParent image {
                                src
                            } male {
                                species ring image { src }
                            } female {
                                species ring image { src }
                            } breedingRecord {
                                id name status log {
                                    id type born dead timeStamp description
                                }
                            }
                        }
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        return view('breedingrecord.breeding')->withData($data);
    }

}
