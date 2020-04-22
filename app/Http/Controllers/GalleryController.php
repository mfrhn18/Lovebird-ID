<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Dropfile;
use GuzzleHttp\Client;

class GalleryController extends Controller
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
                'query' => 'query{user{
                    birdOwned{
                        id ring image{
                            src
                        }
                    }
                }}'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        return view('gallery.gallery')->withData($data);
    }

    public function upload(Request $request)
    {
        $token = Session::get('token');
        $files = $request->file;
        $birdid = $request->role;

        if($files == TRUE)
        {
            $upload = $files;
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
                        createImage(src:"'.$path.'", description:"bird image"){
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
                            updateBirdImage(birdId:"'.$birdid.'", image:"'.$nodeImg.'"){
                                id
                            }
                        }'
                        ]
                    ]
                );
                $response = $request->getBody()->getContents();
                $data = json_decode($response, true);

                return redirect('gallery')->withData($data);
            } else {
                return redirect('gallery')->with('alert','Image tidak tersimpan!');
            }
        } else {
            return redirect('gallery')->with('alert','Image tidak tersimpan!');
        }
    }

    public function store(Request $request)
    {
        $token = Session::get('token');
        $files = $request->file;
        $birdid = $request->role;

        try {
            if ($request->hasFile('file')) {
                $files = $request->file('file');

                foreach ($files as $file) {
                    $fileExtension  = $file->getClientOriginalExtension();
                    $mimeType       = $file->getClientMimeType();
                    $fileSize       = $file->getClientSize();
                    $newName        = uniqid() . '.' . $fileExtension;

                    Storage::disk('dropbox')->putFileAs('public/upload/', $file, $newName);
                    $linkStoreable = $this->dropbox->createSharedLinkWithSettings('public/upload/' . $newName);
                    $link       = $this->dropbox->listSharedLinks('public/upload/' . $newName);
                    $raw        = explode("?", $link[0]['url']);
                    $path       = $raw[0] . '?raw=1';

                    Dropfile::create([
                        'file_name'   => $newName,
                        'file_type'    => $mimeType,
                        'file_size'   => $fileSize
                    ]);
                    
                    foreach ($path as $p){
                        $client = new Client;
                        $request = $client->post(ENV('API_URLL'), [
                            'headers'=>[
                                'Authorization' => 'Bearer ' . $token
                            ],
                            'json' => [
                                'query' => 'mutation{
                                    createImage(src:"'.$path.'", description:"bird image"){
                                        id
                                    }
                                }'
                            ]
                        ]);

                        $response = $request->getBody()->getContents();
                        $data = json_decode($response, true);

                        $node = $data['data']['createImage']['id'];
                        if ($node) {
                            Session::put('gallery.addimage', TRUE);
                            $client = new Client;
                            $request = $client->post(ENV('API_URLL'), [
                                'headers'=>[
                                    'Authorization' => 'Bearer ' . $token
                                ],
                                'json' => [
                                    'query' => 'mutation{
                                        updateBirdImage(birdId:"'.$role.'", image:"'.$node.'"){
                                            id
                                        }
                                    }'
                                ]
                            ]);

                            $response = $request->getBody()->getContents();
                            $data = json_decode($response, true);

                            return redirect('gallery.gallery');
                        } else {
                            return redirect ('gallery.addimage')->with('alert','Image tidak tersimpan!');
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return "Message: {$e->getMessage()}";
        }
    }

}