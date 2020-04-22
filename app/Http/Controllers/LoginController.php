<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function create()
    {
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

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

        if($role){
          
                Session::put('token',$role);
                Session::put('login',TRUE);
                return redirect('home');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !');
            }
    }

    public function destroy($id)
    {
        //
    }
}