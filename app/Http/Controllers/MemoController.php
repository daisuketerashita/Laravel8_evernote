<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;

class MemoController extends Controller
{
    public function index(){
        return view('memo');
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
}
