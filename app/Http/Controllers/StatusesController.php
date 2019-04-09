<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;

class StatusesController extends Controller
{
    //
    public function __constuct()
    {
        $this->middleware('auth');
    }

    public function store(Request $requset)
    {
        $this->validate($requset, [
            'content' => 'required|max:40'
        ]);

        Auth::user()->statuses()->create([
            'content' => $requset['content']
        ]);

        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }
}
