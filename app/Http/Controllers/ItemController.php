<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use DB;
class ItemController extends Controller
{
    public function index(Request $request){
    
        if(auth()->user()){
            $items= Item::query()
            ->where('user_id', '=', auth()->user()->id)
            ->get(); 
            return view('welcome',[
                'items'=>$items
            ]);
        }
        else{
            return view('auth.login');
        }

    }
    public function store(Request $request){
        $this->validate($request , [
            'body'=>'required'
        ]);
        $item=$request->user()->items()->create($request->only('body'));
        return response()->json([
            'item'=>$item,
            'id'=>$item->id,
            'body' => $item->body,
            'user' => auth()->user()->name,
            'date'=>  $item->created_at->toDateTimeString()
            
        ]);
    }

    public function destroy($id){
        $item = DB::table('items')->where('id', $id)->first();
        if($item->user_id !=auth()->user()->id){
            return response()->json([
                  'status'=>"not allowed"
            ]);
        }
        else{
            $res = Item::where('id', '=', $id)->delete();
            return response()->json([
                'status'=>"not success"
          ]);
        }
    }

}
