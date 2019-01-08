<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Playlist;
use Auth;
use Illuminate\Support\Facades\DB;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = Channel::paginate(5);
        return view('channels.display', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::user()->id;
        $channel = DB::table('channels')
        ->select('id')
        ->where('user_id', $id)
        ->get();
        if(isset($channel) && count($channel) > 0){
          return view('channels.create')->with('error_msg', 'You already have a channel!');
        }
        else{
          return view('channels.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->middleware('guest');
        $id = Auth::user()->id;
        $username = DB::table('users')
        ->select('name')
        ->where('id', $id)
        ->get();

        Channel::create([
            'name' => $request['name'],
            'info' => $request['info'],
            'user_id' => Auth::user()->id,
            'username' => $username[0]->name,
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Channel::findOrFail($id);
        $playlists = DB::table('playlists')
        ->where('userid', $channel->user_id)
        ->get();
        $songs = array();
        for ($i=0; $i < count($playlists); $i++) {
          $songs[] = array('name' => $playlists[$i]->playlist_name, 'songs' => DB::table('songs')
          ->select('url')
          ->where('playlist_id', $playlists[$i]->id)
          ->get());
        }

        $urls = self::getURL($songs);

        $counter = 0;

        $playlists = DB::table('playlists')
        ->where('userid', $channel->user_id)
        ->get();
        return view('channels.show',compact('channel', 'playlists', 'urls', 'counter'));
    }

    public function getURL($songs){
        $urls = array();
        $youtube_ids = '';
        for ($i=0; $i < count($songs); $i++) {
          $youtube_ids = '';
            for ($j=0; $j < count($songs[$i]['songs']); $j++) {
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $songs[$i]['songs'][$j]->url, $match);
                $youtube_ids .= $match[1] . ",";
            }
            $urls[] = array('name' => $songs[$i]['name'], 'ids' => $youtube_ids);
        }
        $urls2 = array();
        for ($i=0; $i < count($urls); $i++) {
          $string = "https://www.youtube.com/embed/?playlist=" . $urls[$i]['ids'];
          $urls2[] = array('name' => $urls[$i]['name'], 'url' => $string);
        }
        return $urls2;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel= Channel::find($id);

        return view('channels.edit',compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $channel= Channel::find($id);
        $channel->name =$request->input('name');
        $channel->info =$request->input('info');
        $channel->update();
        return redirect('');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $channel = Channel::find($id);
        $channel->delete();
        return redirect('');
        //
    }
}
