<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class JournalController extends Controller
{
    public function addjournal()
    {
        return view('finance.addjournal');
    }

    public function createjournal(Request $request)
    {
        $token = Session::get('token');
        $month=$request->month;
        $year=$request->year;
        $timestamp=$year.'-'.$month;

        $client = new Client;      
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{user{journal{id timeStamp}
                }}'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        $month = $data['data']['user']['journal'];
        $monthCollect = collect();
        foreach($month as $monthJournal){
            $monthCollect->push($monthJournal['timeStamp']);
        }
        
        if ($monthCollect->contains($timestamp)) {
            return redirect('finance')->with('alert','Jurnal sudah tersedia!');
        }
        else{
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

            return redirect('finance');
        }
    }

    public function addtx()
    {
        return view('finance.addtransaction');
    }

    public function createtx(Request $request, $id)
    {
        $token = Session::get('token');
        $day=$request->day;
        $month=$request->month;
        $year=$request->year;
        $timestamp=$year.'-'.$month.'-'.$day;
        $type=$request->type;
        $desc=$request->desc;
        $amount=$request->amount;
        // dd($id);

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    createTransaction(
                        type:"'.$type.'",
                        description:"'.$desc.'",
                        amount:"'.$amount.'",
                        timeStamp:"'.$timestamp.'",
                        isFinish:true
                    ){
                        id
                    }
                }'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);

        $role = $data['data']['createTransaction']['id'];    

        if($role){    
            Session::put('id',$role);
            Session::put('finance.addtransaction', $id, TRUE);
            $request = $client->post(ENV('API_URLL'), [
                'headers'=>[
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'query' => 'mutation{
                        updateJournalTransactionRelation(journalId:"'.$id.'", transactionId:"'.$role.'"){
                            id
                        }
                    }'
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $data = json_decode($response, true);
            return redirect('finance');
        }
        else{
            return redirect('finance.addtransaction')->with('alert','Data tidak tersimpan!');
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
                'query' => 'query{journalById(filter:"'.$id.'"){
                    id timeStamp transaction{id amount timeStamp type description isFinish}
                }}'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        $dataTrx = json_decode($response, true);
        $transaction = $dataTrx['data']['journalById']['transaction'];
        $collectTypePenasukan = collect();
        $collectTypePengeluaran = collect();
        $pemasukanCalc = 0;
        $pengeluaranCalc = 0; 
        foreach($transaction as $trx){
            $type = explode("-", $trx['type']);
            if($type[0] == "101" || $type[0] == "102" || $type[0] == "103"){
                $pemasukanCalc += $trx['amount'];
                $collectTypePenasukan->push([
                    "type" => $type[0],
                    "description" => $trx['description'],
                    "amount" => $trx['amount']
                ]);
            }
            else{
                $pengeluaranCalc += $trx['amount'];
                $collectTypePengeluaran->push([
                    "type" => $type[0],
                    "description" => $trx['description'],
                    "amount" => $trx['amount']
                ]);
            }
        }

        $data = [
            "pemasukanCalc" => $pemasukanCalc,
            "pengeluaranCalc" => $pengeluaranCalc,
            "pemasukan" => $collectTypePenasukan,
            "pengeluaran" => $collectTypePengeluaran,
            "data" => $dataTrx
        ];
        // dd($data);

        return view('finance.journaldetails')->withData($data);
    }

    public function calculate($id)
    {
        $token = Session::get('token');
        
        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{journalById(filter:"'.$id.'"){
                    id timeStamp transaction{id amount timeStamp type description isFinish}
                }}'
                ]
            ]
        );

        $response = $request->getBody()->getContents();
        

        return view('finance.detailstrx')->withData($data);
    }

}