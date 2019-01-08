<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class PlaylistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $playlists = DB::table('playlists')
        ->where('userid', Auth::user()->id)
        ->get();
        $counter = 0;
        return view('playlist.index', compact('playlists', 'counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amount = DB::table('playlists')
        ->where('userid', Auth::user()->id)
        ->count();
        if ($amount >= 15) {
            return view('playlist.create')->with('amount', 'You reached playlists limit!');
        }
        else {
            return view('playlist.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'name' => 'required|max:35',
          'info' => 'required|max:50',
        ]);
        if ($validator->fails()) {
         return redirect('playlists.create')
                     ->withErrors($validator)
                     ->withInput();
        }
        Playlist::create([
            'userid' => Auth::user()->id,
            'playlist_name' => $request['name'],
            'playlist_info' => $request['info']
        ]);

        return redirect('playlists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $songs = DB::table('songs')
      ->where('playlist_id', $id)
      ->get();
      $counter = 0;
      return view('playlist.show', compact('songs', 'id', 'counter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function deletePlaylist($id){
        DB::table('songs')
        ->where('playlist_id', $id)
        ->delete();
        DB::table('playlists')
        ->where('id', $id)
        ->delete();
        return redirect('playlists');
    }
}
