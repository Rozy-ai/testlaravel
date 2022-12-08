<?php

namespace App\Http\Controllers;

use Vedmant\FeedReader\Facades\FeedReader;

use Illuminate\Http\Request;
use App\Valuta;

class ValutaController extends Controller
{
    public function index()
    {
        $valutas = Valuta::all();
        $current_data = date('d/m/Y');
        $url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$current_data;
        $f = FeedReader::read($url);
        $datas = [];
        //   dd($f->data['child']['']['ValCurs'][0]['child']['']['Valute']);
        foreach ($f->data['child']['']['ValCurs'][0]['child']['']['Valute'] as $key => $value) {
            if($value['child']['']['CharCode'][0]['data'] == 'USD' || $value['child']['']['CharCode'][0]['data'] == 'EUR'){
                $datas[] = $value;
                //dd($value['child']['']['CharCode'][0]['data']);   
            }
        }
        $all[0][] = $datas[0]['child']['']['CharCode'][0]['data'];
        $all[0][] = $datas[0]['child']['']['NumCode'][0]['data'];
        $all[1][] = $datas[1]['child']['']['CharCode'][0]['data'];
        $all[1][] = $datas[1]['child']['']['NumCode'][0]['data'];


 
        return view('valutas.index', compact('valutas','all','datas')); 

        // $f = FeedReader::read('https://www.cbr.ru/scripts/XML_daily.asp?date_req=07/12/2022');
        // //  dd($f->data['child']['']['ValCurs'][0]['child']['']['Valute']);
        // $valutas = [];
        // foreach ($f->data['child']['']['ValCurs'][0]['child']['']['Valute'] as $key => $value) {
        //     if($value['child']['']['CharCode'][0]['data'] == 'USD' || $value['child']['']['CharCode'][0]['data'] == 'EUR'){
        //         $valutas[] = $value;
        //         //dd($value['child']['']['CharCode'][0]['data']);

        //     }
        // }
        // dd($valutas);
        // echo $f->get_title();
        // echo $f->get_items()[0]->get_title();
        // echo $f->get_items()[0]->get_content();
    }

    public function create()
    {
        return view('valutas.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'valuta'=>'required',
            'code'=>'required',
        ]); 

        $valuta = new Valuta([
            'valuta' => $request->get('valuta'),
            'code' => $request->get('code'),
            'procent' => $request->get('procent')
        ]);
        $valuta->save();
        return redirect('/valutas')->with('success', 'Valuta saved.');   
    }

    public function edit($id)
    {
        $valuta = Valuta::find($id);
        return view('valutas.edit', compact('valuta')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'valuta'=>'required',
            'code'=>'required',
        ]); 
        $valuta = Valuta::find($id);
        $valuta->valuta =  $request->get('valuta');
        $valuta->code = $request->get('code');
        $valuta->procent = $request->get('procent');
        $valuta->save();
 
        return redirect('/valutas')->with('success', 'Valuta updated.'); 
    }

    public function show(){
        $valutas = Valuta::all();
        $current_data = date('d/m/Y');
        $url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$current_data;
        $f = FeedReader::read($url);
        if(isset($valutas) && count($valutas) == 0){  
        $datas = [];
        //   dd($f->data['child']['']['ValCurs'][0]['child']['']['Valute']);
        foreach ($f->data['child']['']['ValCurs'][0]['child']['']['Valute'] as $key => $value) {
            if($value['child']['']['CharCode'][0]['data'] == 'USD' || $value['child']['']['CharCode'][0]['data'] == 'EUR'){
                $datas[] = $value;
                //dd($value['child']['']['CharCode'][0]['data']);   
            }
        }
        $all[0]['valuta'] = $datas[0]['child']['']['CharCode'][0]['data'];
        $all[0]['code'] = $datas[0]['child']['']['NumCode'][0]['data'];
        $all[0]['price'] = $datas[0]['child']['']['Value'][0]['data'];
        $all[1]['valuta'] = $datas[1]['child']['']['CharCode'][0]['data'];
        $all[1]['code'] = $datas[1]['child']['']['NumCode'][0]['data'];
        $all[1]['price'] = $datas[1]['child']['']['Value'][0]['data'];
        $flag = true;
        return view('index', compact('all','flag'));
        } else {
            $datas = [];
            // dd($valutas[0]['valuta']);
            //   dd($f->data['child']['']['ValCurs'][0]['child']['']['Valute']);
            foreach ($f->data['child']['']['ValCurs'][0]['child']['']['Valute'] as $key => $value) {
                foreach ($valutas as $key => $valuta) {
                    if($value['child']['']['CharCode'][0]['data'] == $valuta->valuta){
                        $datas[] = $value;
                        $datas[$key]['procent'] = $valuta->procent;
                        //dd($value['child']['']['CharCode'][0]['data']);   
                    }
                }
   
            }
            foreach ($datas as $key => $data) {
                $all[$key]['valuta'] = $data['child']['']['CharCode'][0]['data'];
                $all[$key]['code'] = $data['child']['']['NumCode'][0]['data'];
                $all[$key]['price'] = $data['child']['']['Value'][0]['data'];
                $all[$key]['procent'] = $data['procent'];
            }
            $flag = false;
            return view('index', compact('all','flag'));

        }
    }

    public function destroy($id)
    {
        $valuta = Valuta::find($id);
        $valuta->delete(); 
 
        return redirect('/valutas')->with('success', 'Valuta removed.'); 
    } 
}
