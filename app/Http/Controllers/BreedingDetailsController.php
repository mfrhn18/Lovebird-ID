<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class BreedingDetailsController extends Controller
{

    public function index()
    {
        return view('breedingrecord.breedingdetails');
    }

    public function store($id)
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{
                    birdParentById(
                        filter:"'.$id.'"
                    ){
                        breedingRecord{
                            name
                        }
                    }
                }'
                ]
            ]
        );
        
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        $check = $data['data']['birdParentById']['breedingRecord'];
        $counter = count(collect($check)) + 1;
        $name = "Batch-" . $counter;
        $status = "on process";

        if($status==true)
        {
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createBreedingRecord(
                            name:"'.$name.'",
                            status:"'.$status.'"
                        ){
                            id
                        }
                    }'
                    ]
                ]
            );
    
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
    
            $role = $data['data']['createBreedingRecord']['id'];

            if($role){
                Session::put('id',$role);
                $date=now();
                $timestamp=$date->format('d-m-Y');
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            createBreedingLog(
                                type:"Breeding Log",
                                timeStamp:"'.$timestamp.'",
                                description:"Batch dibuat"
                            ){
                                id
                            }
                        }'
                    ]
                ]);
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
                $idrec = $data['data']['createBreedingLog']['id'];

                if($idrec){
                    Session::put('recid',$idrec);
                    Session::put('id',$role);
                    $request = $client->post(ENV('API_URLL'), [
                        'headers'=>[
                            'Authorization' => 'Bearer ' . $token
                        ],
                        'json' => [
                            'query' => 'mutation{
                                updateBreedingRecordLogRelation(breedingRecord:"'.$role.'", log:"'.$idrec.'"){
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
                Session::put('breedingrecord.breedingdetails', $id, TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBirdParentBreedingRecordRelation(birdParent:"'.$id.'", breedingRecord:"'.$role.'"){
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
                return redirect('breedingrecord.breedingdetails', $id)->with('alert','Burung tidak tersimpan!');
            }
        }
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
                'query' => 'query{
                    birdParentById(filter:"'.$id.'"){
                        id noParent image {
                            src
                        } male {
                            ring species image {
                                src
                            }
                        } female { 
                            ring species image {
                                src
                            }
                        } breedingRecord {
                            id name status log {
                                id type born dead timeStamp description
                            }
                        }
                    }
                }'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        
        // dd($egg);
        
        return view('breedingrecord.breedingdetails')->withData($data);
    }

    public function record($id)
    {
        $token = Session::get('token');

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{
                    breedingRecordById(filter:"'.$id.'"){
                        id name status log{
                            id type born dead timeStamp description
                        }
                    }
                }'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);      
        
        return view('breedingrecord.bdaddrec')->withData($data);
    }

    public function recstore(Request $request, $id)
    {
        $token = Session::get('token');
        $log=$request->log;
        $record=$request->record;
        $egg=$request->egg;
        $born=$request->born;
        $dead=$request->dead;
        $date=now();
        $timestamp=$date->format('d-m-Y');
        // dd($log,$record,$timestamp);

        if($log=='Breeding Log')
        {
            $client = new Client;
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createBreedingLog(
                            type:"'.$log.'",
                            timeStamp:"'.$timestamp.'",
                            description:"'.$record.'"
                        ){
                            id
                        }
                    }'
                    ]
                ]
            );
    
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);

            $role = $data['data']['createBreedingLog']['id'];
    
            if($role){    
                Session::put('id',$role);
                Session::put('breedingrecord.bdaddrec', $id, TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBreedingRecordLogRelation(breedingRecord:"'.$id.'", log:"'.$role.'"){
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
        }
        else if($log=='Bertelur')
        {
            $client = new Client;
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createBreedingLog(
                            type:"'.$log.'",
                            timeStamp:"'.$timestamp.'",
                            description:"Telur berjumlah - '.$egg.'"
                        ){
                            id
                        }
                    }'
                    ]
                ]
            );
    
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);

            $role = $data['data']['createBreedingLog']['id'];
    
            if($role){    
                Session::put('id',$role);
                Session::put('breedingrecord.bdaddrec', $id, TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBreedingRecordLogRelation(breedingRecord:"'.$id.'", log:"'.$role.'"){
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
        }
        else if($log=='Hatch')
        {
            $client = new Client;
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createBreedingLogHatch(
                            type:"'.$log.'",
                            born:"'.$born.'",
                            dead:"'.$dead.'",
                            timeStamp:"'.$timestamp.'",
                            description:"Menetas - '.$born.', Mati - '.$dead.'"
                        ){
                            id
                        }
                    }'
                    ]
                ]
            );
    
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);

            $role = $data['data']['createBreedingLogHatch']['id'];
    
            if($role){    
                Session::put('id',$role);
                Session::put('breedingrecord.bdaddrec', $id, TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBreedingRecordLogRelation(breedingRecord:"'.$id.'", log:"'.$role.'"){
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
        }
    }

    public function closebatch($id)
    {
        $token = Session::get('token');
        $date=now();
        $timestamp=$date->format('d-m-Y');

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    createBreedingLog(
                        type:"Close Batch",
                        timeStamp:"'.$timestamp.'",
                        description:"Batch ditutup pada tanggal '.$timestamp.'"
                    ){
                        id
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        //Update Breeding Record Log Relation
        $role = $data['data']['createBreedingLog']['id'];
        if($role)
        {
            Session::put('id', $role);
            Session::put('breedingrecord.bdaddrec');
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        updateBreedingRecordLogRelation(breedingRecord:"'.$id.'", log:"'.$role.'"){
                            id
                        }
                    }'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            //Update Breeding Record Status
            $brstat = $data['data']['updateBreedingRecordLogRelation']['id'];
            if($role)
            {
                Session::put('id', $brstat);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateBreedingRecordStatus(breedingRecordId:"'.$id.'", status:"Finish"){
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
                return redirect('breedingrecord.breedingdetails', $id)->with('alert','Burung tidak tersimpan!');
            }
        }
    }
}