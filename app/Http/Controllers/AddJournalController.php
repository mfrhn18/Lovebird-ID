<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class AddJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('finance.addjournal');
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
        $timeStamp=$request->timeStamp;

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    createJournal(
                        timeStamp:"'.$timestamp.'"
                    ){
                        id
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        // $role = $data['data']['createTransaction']['id'];    

        // if($role){    
        //     Session::put('id',$role);
        //     Session::put('addtransaction',TRUE);
        //     $request = $client->post(ENV('API_URLL'), [
        //         'headers'=>[
        //             'Authorization' => 'Bearer ' . $token
        //         ],
        //         'json' => [
        //             'query' => 'mutation{
        //                 updateJournalTransactionRelation(journalId:"'.$jid'", transactionId:"'.$role.'"){
        //                     id
        //                 }
        //             }'
        //             ]
        //         ]
        //     );
        //     $response = $request->getBody()->getContents();
        //     $data = json_decode($response, true);
        //     return redirect('birdfarm');
        // }
        // else{
        //     return redirect('regbird')->with('alert','Burung tidak tersimpan!');
        // }

        return redirect('finance.finance');
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
