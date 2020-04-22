<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Dropfile;
use GuzzleHttp\Client;

class BirdFarmController extends Controller
{
    public function __construct()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }
    
    public function index()
    {
        $token = Session::get('token');

        $headers = [
            'Authorization' => 'Bearer ' . $token,        
            'Accept'        => 'application/json',
        ];

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{user{
                    birdOwned{
                        id name ring species age type gender breeder image{src}}
                }}'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        return view('birdfarm.birdfarm')->withData($data);
    }

    public function rbird()
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{
                    user{birdParent{
                        noParent
                        }
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        return view('birdfarm.regbird')->withData($data);
    }

    public function createbird(Request $request)
    {
        $token = Session::get('token');
        $name=$request->name;
        $type=$request->type;
        $ring=$request->ring;
        $breeder=$request->breeder;
        $species=$request->species;
        $gender=$request->gender;
        $age=$request->age;
        // $age=$birth->format('d-m-Y');
        $img=$request->file;

        // dd($age);

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    createBird(
                        name:"'.$name.'",
                        type:"'.$type.'",
                        ring:"'.$ring.'",
                        breeder:"'.$breeder.'",
                        species:"'.$species.'",
                        gender:"'.$gender.'",
                        age:"'.$age.'"
                    ){
                        id
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $role = $data['data']['createBird']['id'];      

        if($img == true){
            $upload = $img;
            $newName = uniqid() . '.' . $upload->getClientOriginalExtension();

            Storage::disk('dropbox')->putFileAs('public/lovebird-id/bird-image/', $upload, $newName);
            $linkStoreable = $this->dropbox->createSharedLinkWithSettings('public/lovebird-id/bird-image/' . $newName);
            $link       = $this->dropbox->listSharedLinks('public/lovebird-id/bird-image/' . $newName);
            $raw        = explode("?", $link[0]['url']);
            $path       = $raw[0] . '?raw=1';

            Dropfile::create([
                'file_name'   => $newName,
                'file_type'   => $upload->getClientOriginalExtension(),
                'file_size'   => $upload->getSize()
            ]);

            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createImage(src:"'.$path.'", description:""){
                            id
                        }
                    }'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            // dd($data);
            $nodeImg = $data['data']['createImage']['id'];
            if($nodeImg){
                Session::put('id',$role);
                Session::put('regbird',TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBirdImage(birdId:"'.$role.'", image:"'.$nodeImg.'"){
                                id
                            }
                        }'
                        ]
                    ]
                );
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
            }
        }

        if($role){    
            Session::put('id',$role);
            Session::put('birdfarm.regbird',TRUE);
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        updateBirdRelation(birdId:"'.$role.'"){
                            id
                        }
                    }'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect('birdfarm');
        }
        else{
            return redirect('birdfarm')->with('alert','Burung tidak tersimpan!');
        }
    }

    public function rinduk()
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{
                    user{birdOwned{
                        id name ring gender species type
                        }
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        return view('birdfarm.reginduk')->withData($data);
    }

    public function createinduk(Request $request)
    {
        $token = Session::get('token');
        $noParent=$request->noParent;
        $male=$request->male;
        $idm=$request->idm;
        $female=$request->female;
        $idfem=$request->idfem;
        $img=$request->file;
        // dd($male,$female,$noParent);
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    createBirdParent(
                        noParent:"'.$noParent.'",
                        birdMaleId:"'.$male.'",
                        birdFemaleId:"'.$female.'"
                    ){
                        id
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $role = $data['data']['createBirdParent']['id'];      

        if($img == true){
            $upload = $img;
            $newName = uniqid() . '.' . $upload->getClientOriginalExtension();

            Storage::disk('dropbox')->putFileAs('public/lovebird-id/bird-image/', $upload, $newName);
            $linkStoreable = $this->dropbox->createSharedLinkWithSettings('public/lovebird-id/bird-image/' . $newName);
            $link       = $this->dropbox->listSharedLinks('public/lovebird-id/bird-image/' . $newName);
            $raw        = explode("?", $link[0]['url']);
            $path       = $raw[0] . '?raw=1';

            Dropfile::create([
                'file_name'   => $newName,
                'file_type'   => $upload->getClientOriginalExtension(),
                'file_size'   => $upload->getSize()
            ]);

            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createImage(src:"'.$path.'", description:"bird parent"){
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
                Session::put('id',$role);
                Session::put('reginduk',TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBirdParentImage(birdParentId:"'.$role.'", image:"'.$nodeImg.'"){
                                id
                            }
                        }'
                        ]
                    ]
                );
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
            }
        }

        if($role){    
            Session::put('id',$role);
            Session::put('birdfarm.reginduk',TRUE);
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        updateBirdParentRelation(birdParentId:"'.$role.'"){
                            id
                        }
                    }'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect('breeding');
        }
        else{
            return redirect('reginduk')->with('alert','Burung tidak tersimpan!');
        }
    }
}