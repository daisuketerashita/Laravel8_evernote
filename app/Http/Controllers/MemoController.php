<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;

class MemoController extends Controller
{
    public function index(){
        $memos = Memo::where('user_id',Auth::id())->orderBy('updated_at','desc')->get();

        return view('memo',[
            'name' => $this->getLoginUserName(),
            'memos' => $memos
        ]);
    }

    /* メモの追加 */
    public function add(){
        Memo::create([
            'user_id' => Auth::id(),
            'title' => '新規メモ',
            'content' => ''
        ]);

        return redirect()->route('memo.index');
    }

    /* ユーザー名取得 */
    public function getLoginUserName(){
        $user = Auth::user();

        $name = '';
        if($user){
            if(7 < mb_strlen(($user->name))){
                $name = mb_substr($user->name,0,7)."...";
            }else{
                $name = $user->name;
            }
        }

        return $name;
    }
}
