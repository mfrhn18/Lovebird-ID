<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Dropfile;
use GuzzleHttp\Client;

class EditBreederController extends Controller
{
    public function __construct()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        
        $ktp=$data['data']['user']['ktp'];
        $phone=$data['data']['user']['phone'];
        $city=$data['data']['user']['city'];
        $address=$data['data']['user']['address'];
        $location=$data['data']['user']['location'];
        $farmName=$data['data']['user']['farmName'];
        $img=$data['data']['user']['image']['src'];

        Session::put('ktp',$ktp);
        Session::put('phone',$phone);
        Session::put('city',$city);
        Session::put('address',$address);
        Session::put('location',$location);
        Session::put('farmName',$farmName);
        Session::put('image',$img);

        return view('profile.editbreeder');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = Session::get('token');
        $ktp=$request->ktp;
        $city=$request->city;
        $address=$request->address;
        $phone=$request->phone;
        $location=$request->location;
        $farmName=$request->farmName;
        $gender=$request->gender;
        $birthday=$request->birthday;
        $dp=$request->file;
        $fktp=$request->fktp;

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
                        createImage(src:"'.$path.'", description:""){
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
            Session::put('id',$role);
            Session::put('profile.editbreeder',TRUE);
            return redirect('profile.breeder');
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
        //                 createImage(src:"'.$path.'", description:""){
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
            return redirect('profile.breeder');
        }
        else{
            return redirect('profile.editbreeder')->with('alert','Profile tidak tersimpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
