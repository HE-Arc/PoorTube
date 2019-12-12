<?php

namespace App\Http\Controllers;

use App\Video;
use App\Like;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$videos = Video::all();//Video::latest()->paginate(5);
        $videos = DB::select('SELECT * from video order by created_at DESC');
        // Pour la version pagination ajouter : {!! $videos->links() !!} dans index.blade.php après END VIDEOS
        $likes = Like::all();
        return view('videos.index', compact(['videos', 'likes']));//->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'video' => 'required',
        ]);

        $input['video'] = time() . '.' . $request->video->getClientOriginalExtension();
        $request->video->move(public_path('videos-gallery'), $input['video']);

        if(Auth::check())
        {
          $input['name'] = $request->name;
          $input['public'] = 1 ; //$request->input("public");
          $input['fk_owner'] = Auth::id();
          $input['author'] = Auth::user()->name;

          Video::create($input);

          return redirect()->route('videos.index')->with('success', 'Video created successfully');
        }
        
        return redirect()->route('videos.index')->with('warning', 'You must be connected');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
      return redirect()->route('videos.index')->with('success', 'Video created successfully');
        //return view('videos.show', compact($video));
    }

    public function allVideos()
    {
      // $myVideos = DB::table('video')->where('fk_owner', (string)Auth::id());
      // die((string)$myVideos);
      if(Auth::check())
      {
        $myVideos = DB::select('select * from video where fk_owner = ?', [Auth::id()]);
        $likes = Like::all();
        return view('videos.myvideo', compact(['myVideos', 'likes']));//->with('i', (request()->input('page', 1)-1)*5);
      }

      return redirect()->route('videos.index')->with('warning', 'you must be connected');      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //return view('videos.edit', compact($video));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        $myVideos = DB::select('select * from video where fk_owner = ?', [Auth::id()]);
        $likes = Like::all();
        return view('videos.myvideo', compact(['myVideos', 'likes']))->with('success', 'Video deleted successfully');
    }

    public function like($video_id) {
      if(Auth::check())
      {
        $input['video_id'] = $video_id;
        $input['user_id'] = Auth::id();
        if(Like::where('user_id', '=', $input['user_id'])->where('video_id', '=', $input['video_id'])->exists()) {
          Like::where('user_id', '=', $input['user_id'])->where('video_id', '=', $input['video_id'])->delete();
          return back()->with('success', 'disliked successfully');
        } else {
          Like::create($input);
          return back()->with('success', 'liked successfully');
        }
      }

      return back()->with('warning', 'you must be connected');//redirect()->route('videos.index')->with('success', 'you must be connected');
      
    }

    // public static function doYouLike($video_id) {
    //   // TODO look if id is checked
    //   if(Auth::check())
    //   {
    //     $input['video_id'] = $video_id;
    //     //$input['user_id'] = Auth::id();
    //     $input['user_id'] = Auth::id();
    //     if(Like::where('user_id', '=', $input['user_id'])->where('video_id', '=', $input['video_id'])->exists()) {
    //       return 1;
    //     } else {
    //       return 0;
    //     }
    //   }
    //   return 0;
    // }
}
