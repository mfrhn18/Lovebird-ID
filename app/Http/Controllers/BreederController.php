<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Dropfile;
use GuzzleHttp\Client;

class BreederController extends Controller
{
    public function __construct()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }
 
    public function index()
    {
        $token = Session::get('token');

        $client = new Client;
      
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{user{id name city location address phone birthday farmName ktp ktpImage{src} image{src} 
                birdOwned{id name ring breeder gender species type image{src}}
                }}'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $user=$data['data']['user']['name'];
        Session::put('name',$user);
        
        
        return view('profile.breeder')->withData($data);
    }

    public function editbreeder()
    {
        $token = Session::get('token');
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{user{id name city location address phone birthday farmName ktp image{src}
                }}'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        
        $bday=$data['data']['user']['birthday'];
        $ktp=$data['data']['user']['ktp'];
        $phone=$data['data']['user']['phone'];
        $city=$data['data']['user']['city'];
        $address=$data['data']['user']['address'];
        $location=$data['data']['user']['location'];
        $farmName=$data['data']['user']['farmName'];
        $img=$data['data']['user']['image']['src'];

        Session::put('birthday',$bday);
        Session::put('ktp',$ktp);
        Session::put('phone',$phone);
        Session::put('city',$city);
        Session::put('address',$address);
        Session::put('location',$location);
        Session::put('farmName',$farmName);
        Session::put('image',$img);

        return view('profile.editbreeder');
    }

    public function store(Request $request)
    {
        $token = Session::get('token');
        $oldDP = Session::get('image');
        $ktp=$request->ktp;
        $city=$request->city;
        $address=$request->address;
        $phone=$request->phone;
        $location=$request->location;
        $farmName=$request->farmName;
        $gender=$request->gender;
        $birthday=$request->birthday;
        $dp=$request->file;
        // $fktp=$request->fktp;

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    updateUser(
                        farmName:"'.$farmName.'", address:"'.$address.'", city:"'.$city.'",
                        ktp:"'.$ktp.'", location:"'.$location.'", birthday:"'.$birthday.'",
                        gender:"'.$gender.'", phone:"'.$phone.'"){
                        id
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $role = $data['data']['updateUser']['id'];    
        
        if($dp == true){
            $upload = $dp;
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

            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createImage(src:"'.$path.'", description:"profile"){
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
                Session::put('profile.editbreeder',TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateUserImage(image:"'.$nodeImg.'"){
                                id
                            }
                        }'
                        ]
                    ]
                );
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);
            }
        } else {
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        createImage(src:"'.$oldDP.'", description:"profile"){
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
                Session::put('profile.editbreeder',TRUE);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateUserImage(image:"'.$nodeImg.'"){
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

        // if($fktp == true){
        //     $upload = $fktp;
        //     $newName = uniqid() . '.' . $upload->getClientOriginalExtension();

        //     Storage::disk('dropbox')->putFileAs('public/upload/', $upload, $newName);
        //     $linkStoreable = $this->dropbox->createSharedLinkWithSettings('public/upload/' . $newName);
        //     $link       = $this->dropbox->listSharedLinks('public/upload/' . $newName);
        //     $raw        = explode("?", $link[0]['url']);
        //     $path       = $raw[0] . '?raw=1';

        //     Dropfile::create([
        //         'file_name'   => $newName,
        //         'file_type'   => $upload->getClientOriginalExtension(),
        //         'file_size'   => $upload->getSize()
        //     ]);

        //     $request = $client->post(ENV('API_URLL'), [
        //         'headers'=>[
        //             'Authorization' => 'Bearer ' . $token
        //         ],
        //         'json' => [
        //             'query' => 'mutation{
        //                 createImage(src:"'.$path.'", description:"ktp"){
        //                     id
        //                 }
        //             }'
        //             ]
        //         ]
        //     );
        //     $response = $request->getBody()->getContents();
        //     $data = json_decode($response, true);

        //     $nodeImg = $data['data']['createImage']['id'];
        //     if($nodeImg){
        //         Session::put('id',$role);
        //         Session::put('regbird',TRUE);
        //         $request = $client->post(ENV('API_URLL'), [
        //             'headers'=>[
        //                 'Authorization' => 'Bearer ' . $token
        //             ],
        //             'json' => [
        //                 'query' => 'mutation{
        //                     updateUserImageKtp(image:"'.$nodeImg.'"){
        //                         id
        //                     }
        //                 }'
        //                 ]
        //             ]
        //         );
        //         $response = $request->getBody()->getContents();
        //         $data = json_decode($response, true);
        //     }
        // }
        // else {
        //     $request = $client->post(ENV('API_URLL'), [
        //         'headers'=>[
        //             'Authorization' => 'Bearer ' . $token
        //         ],
        //         'json' => [
        //             'query' => 'mutation{
        //                 createImage(src:"null", description:"ktp"){
        //                     id
        //                 }
        //             }'
        //             ]
        //         ]
        //     );
        //     $response = $request->getBody()->getContents();
        //     $data = json_decode($response, true);

        //     $nodeImg = $data['data']['createImage']['id'];
        //     if($nodeImg){
        //         Session::put('id',$role);
        //         Session::put('regbird',TRUE);
        //         $request = $client->post(ENV('API_URLL'), [
        //             'headers'=>[
        //                 'Authorization' => 'Bearer ' . $token
        //             ],
        //             'json' => [
        //                 'query' => 'mutation{
        //                     updateUserImageKtp(image:"'.$nodeImg.'"){
        //                         id
        //                     }
        //                 }'
        //                 ]
        //             ]
        //         );
        //         $response = $request->getBody()->getContents();
        //         $data = json_decode($response, true);
        //     }
        // }
        
        if($role){    
            Session::put('id',$role);
            Session::put('profile.editbreeder',TRUE);
            return redirect('breeder');
        }
        else{
            return redirect('editbreeder')->with('alert','Profile tidak tersimpan!');
        }
    }

}
