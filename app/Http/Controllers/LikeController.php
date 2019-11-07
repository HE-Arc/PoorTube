<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function index()
    {
      $likes = Like::all();
      return $likes;
    }

    public function show($id)
    {
      return view('like', ['name' => Like::where('fk_user', $id)->firstOrFail()]);
    }

    public function destroy($fk_user, $fk_video)
    {
      Like::where('fk_user', $fk_user, 'fk_video', $fk_video)->delete();
    }

    public function store($fk_user, $fk_video)
    {
      $like = new Like();
      $like->fk_user = $fk_user;
      $like->fk_video = $fk_video;
      if($like->save())
      {
        return true;
      }
    }

    public function update(Request $request, Like $like)
    {
      if($like->fill($request->all())->save())
      {
        return true;
      }
    }
}
