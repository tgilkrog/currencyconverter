<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Converter;

class PagesController extends Controller
{
    public function index(){
        $converter = new Converter();
        $data = $converter->getList();

        $result = '0.00';
        return view('index')->with('list', $data)->with('result',$result);
    }

    public function convert(Request $request){
        $converter = new Converter();

        $result = $converter->convert(($request->amount), ($request->from), ($request->to));
        $data = $converter->getList();

        return view('index')->with('list', $data)->with('result', $result);
    }
}
