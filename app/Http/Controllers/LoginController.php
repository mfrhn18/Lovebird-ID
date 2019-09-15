<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

  
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      //untuk fungsi login
    public function store(Request $request)
    {
        $email=$request->email;
        $password=$request->password;

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'json' => [
                'query' => 'mutation{
                    login(
                        email:"'.$email.'",
                        password:"'.$password.'") { 
                            token 
                    }
                }'
            ]
        ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $role = $data['data']['login']['token'];      

        if($role){ //apakah email tersebut ada atau tidak
          
                Session::put('token',$role);
                Session::put('login',TRUE);
                return redirect('home');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !');
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