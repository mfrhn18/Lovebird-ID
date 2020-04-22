<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class RegisterController extends Controller
{

    public function index()
    {
        return view('register');
    }

    public function create()
    {
        //
    }

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
                        }
                    }'
            ]
        ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        // dd($data);

        $role = $data['data']['signup']['token'];
        if($role)
        {
            Session::put('token',$role);
            Session::put('register',TRUE);
            return redirect('home');
            }
        else {
            return redirect('register')->with('alert', 'Registrasi gagal!');
        }

    }

}
