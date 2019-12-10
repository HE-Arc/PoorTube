<?php

namespace App\Http\Controllers;

use App\Video;
use App\Like;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $videos = Video::all();//Video::latest()->paginate(5);
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
            // 'duration' => 'required',
            // 'public' => 'required',
            // 'fk_owner' => 'required',
        ]);

        $input['video'] = time() . '.' . $request->video->getClientOriginalExtension();
        $request->video->move(public_path('videos-gallery'), $input['video']);

        if(Auth::check())
        {
          $input['name'] = $request->name;
          $input['public'] = 1 ; //$request->input("public");
          $input['fk_owner'] = Auth::id();

          Video::create($input);

          return redirect()->route('videos.index')->with('success', 'Video created successfully');
        }
        
        return redirect()->route('videos.index')->with('success', 'You must be connected');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
      echo "salut";
      return redirect()->route('videos.index')->with('success', 'Video created successfully');
        //return view('videos.show', compact($video));
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
        echo $video;
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully');
    }

    public function like($video_id) {
      $input['video_id'] = $video_id;
      //$input['user_id'] = Auth::id();
      $input['user_id'] = 1;
      if(Like::where('user_id', '=', $input['user_id'])->where('video_id', '=', $input['video_id'])->exists()) {
        Like::where('user_id', '=', $input['user_id'])->where('video_id', '=', $input['video_id'])->delete();
        return redirect()->route('videos.index')->with('success', 'disliked successfully');
      } else {
        Like::create($input);
        return redirect()->route('videos.index')->with('success', 'liked successfully');
      }
    }

    public static function doYouLike($video_id) {
      $input['video_id'] = $video_id;
      //$input['user_id'] = Auth::id();
      $input['user_id'] = 1;
      if(Like::where('user_id', '=', $input['user_id'])->where('video_id', '=', $input['video_id'])->exists()) {
        return 1;
      } else {
        return 0;
      }
    }
}
