<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
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
        $email=$request->email;
        $password=$request->password;
        $name=$request->name;    

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'json' => [
                'query' => 'mutation{
                    signup(
                        email:"'.$email.'",
                        password:"'.$password.'",
                        name:"'.$name.'",
                        ) { 
                            token
                            id 
                        }
                    }'
            ]
        ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $role = $data['data']['signup']['token'];      
        dd($data);
        if($role){ //apakah email tersebut ada atau tidak
          
                Session::put('token',$role);
                // Session::put('name',$nama);
                Session::put('register',TRUE);
                return redirect('home');
            }
            else{
                return redirect('register')->with('alert','Password tidak sesuai!');
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
