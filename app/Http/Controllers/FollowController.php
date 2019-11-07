<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
  public function store(Request $request)
  {
    $follow = new Follow();
    $follow->fk_follower = $request->fk_follower;
    $follow->fk_followed = $request->fk_followed;
    if($follow->save())
    {
      return true;
    }
  }
}
