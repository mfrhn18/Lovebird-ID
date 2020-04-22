<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Dropfile;
use GuzzleHttp\Client;

class BirdDetailsController extends Controller
{
    public function __construct()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }

    public function index()
    {
        return view('birdfarm.birddetails');
    }

    public function show($id)
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{birdFilterById(filter:"'.$id.'"){
                    id name ring type species gender age breeder image{src} parent{noParent} dna{src}
                }}'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        return view('birdfarm.birddetails')->withData($data);
    }

    public function edit($id)
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{birdFilterById(filter:"'.$id.'"){
                    id name ring type species gender age breeder image{src} parent{id noParent} dna{src}
                }}'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $datax = json_decode($response, true);
        $parent = $datax['data']['birdFilterById']['parent'];
        if($parent['noParent'] == null){
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'query{user{
                        birdParent{id noParent}
                    }}'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $noParent = json_decode($response, true);
        }
        
        $data = [
            "data" => $datax,
            "parent" => $noParent
        ];

        return view('birdfarm.editbird')->withData($data);
    }

    public function store(Request $request, $id)
    {
        $token = Session::get('token');
        $img    = $request->file;
        $species= $request->species;
        $type   = $request->type;
        $name   = $request->name;
        $age    = $request->age;
        $parent = $request->parent;
        $breeder= $request->breeder;

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation
                {
                    updateBirdInformation{
                        name:"'.$name.'",
                        type:"'.$type.'",
                        birdId:"'.$id.'",
                        parentId:"'.$parent.'",
                        species:"'.$species.'",
                        age:"'.$age.'",
                        breeder:"'.$breeder.'"
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        return view('birddetails')->withData($data);
    }

    public function dna(Request $request, $id)
    {
        $token  = Session::get('token');
        $dna    = $request->file;

        if($dna == TRUE)
        {
            $upload = $dna;
            $newName = uniqid() . '.' . $upload->getClientOriginalExtension();

            Storage::disk('dropbox')->putFileAs('public/upload/', $upload, $newName);
            $linkStoreable = $this->dropbox->createSharedLinkWithSettings('public/upload/' . $newName);
            $link       = $this->dropbox->listSharedLinks('public/upload/' . $newName);
            $raw        = explode("?", $link[0]['url']);
            $path       = $raw[0] . '?raw=1';

            Dropfile::create([
                'file_name'   => $newName,
                'file_type'   => $upload->getClientOriginalExtension(),
                'file_size'   => $upload->getSize()
            ]);
            
            $client = new Client;
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createImage(src:"'.$path.'", description:"bird dna"){
                            id
                        }
                    }'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);

            $nodeImg = $data['data']['createImage']['id'];
            if($nodeImg){
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBirdDna(birdId:"'.$id.'", image:"'.$nodeImg.'"){
                                id
                            }
                        }'
                        ]
                    ]
                );
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);

                return redirect('birddetails')->withData($data);
            } else {
                return redirect('birddetails')->with('alert','Dna tidak tersimpan!');
            }
        } else {
            return redirect('birddetails')->with('alert','Dna tidak tersimpan!');
        }
    }
}