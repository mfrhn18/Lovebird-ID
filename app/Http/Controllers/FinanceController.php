<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class FinanceController extends Controller
{
    public function index()
    {
        setlocale(LC_ALL, 'id_ID');

        $token = Session::get('token');

        $client = new Client;      
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'query{user{journal{id timeStamp transaction{id amount timeStamp type description isFinish}}
                }}'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $dataTrx = json_decode($response, true);
        
        $jurnal = collect($dataTrx['data']['user']['journal'])->flatten(2)->reject(function ($value, $key) {
            return !is_array($value);
        });

        $dropdown = $jurnal->map(function($item){
            return substr($item['timeStamp'], 0, 7);
        })->unique()
            ->sort(function($a, $b)  { 
                if ($a == $b) return 0;
                return ($a > $b) ? -1 : 1; 
            })
            ->values()
            ->transform(function($item){
                return $item.'_'.strftime('%B', strtotime($item.'-01'));
            });
        // dump($dropdown);

        $aggregates = collect();

        $transactions = $jurnal->groupBy(function ($item) {
            return '_'.substr($item['type'], 0, 3);
        });
        
        $filter = isset($_GET['filter']) ? strtolower($_GET['filter']) : 'all';
        // dump($filter);
        if($filter == 'all'){
            $transactions = $jurnal->groupBy(function ($item) {
                return '_'.substr($item['type'], 0, 3);
            });
        }else{
            $transactions = $jurnal->filter(function($item, $key) use($filter){
                return substr($item['timeStamp'], 0, 7) == $filter;
            })->groupBy(function ($item) {
                return '_'.substr($item['type'], 0, 3);
            });
        }

        $aggregates = $transactions->map(function($trx_type){
            return $trx_type->sum('amount');
        });

        //total
        $aggregates->put('total', $aggregates->sum()); 

        //debet
        $aggregates->put('debet', $aggregates->filter(function($item, $key){
            return strpos($key, '_10') === 0;
        })->sum()); 

        //kredit
        $aggregates->put('kredit', $aggregates->filter(function($item, $key){
            return strpos($key, '_20') === 0;
        })->sum()); 

        $data = [
            "data" => $dataTrx,
            "dropdown" => $dropdown,
            "aggregates" => $aggregates,
        ];
        //dd($data);
        return view('finance.finance')->withData($data);
    }

    public function createtrx(Request $request)
    {
        $token = Session::get('token');
        $date=now();
        $jts=$date->format('d-m-Y');

        $datepicker=$request->datepicker;
        $type=$request->type;
        $desc=$request->desc;
        $amount=$request->amount;

        // dd($datepicker,$type,$desc,$amount,$date,$jts);

        $client = new Client;
        $request = $client->post(ENV('API_URLL'), [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token
            ],
            'json' => [
                'query' => 'mutation{
                    createJournal(
                        timeStamp:"'.$jts.'"
                    ){
                        id
                    }
                }'
                ]
            ]
        );
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        $jid = $data['data']['createJournal']['id'];
        
        if($jid){
            Session::put('id',$jid);
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
                            timeStamp:"'.$datepicker.'",
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
            $tid = $data['data']['createTransaction']['id'];

            if($tid){
                Session::put('id', $tid);
                Session::put('jid', $jid);
                $request = $client->post(ENV('API_URLL'), [
                    'headers'=>[
                        'Authorization' => 'Bearer ' . $token
                    ],
                    'json' => [
                        'query' => 'mutation{
                            updateJournalTransactionRelation(journalId:"'.$jid.'", transactionId:"'.$tid.'"){
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
                return redirect('finance')->with('alert!', 'Data tidak tersimpan!');
            }
        }
        else{
            return redirect('finance')->with('alert!', 'Data tidak tersimpan!');
        }
    }

}
