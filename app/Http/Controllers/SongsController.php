<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Song;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class SongsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //   'name' => 'required|max:35',
        //   'info' => 'required|max:50',
        // ]);
        // if ($validator->fails()) {
        //  return redirect('playlists.create')
        //              ->withErrors($validator)
        //              ->withInput();
        // }
        // Playlist::create([
        //     'userid' => Auth::user()->id,
        //     'playlist_name' => $request['name'],
        //     'playlist_info' => $request['info']
        // ]);

        return redirect('playlists');
    }

    public function add(Request $request, $id)
    {
        //AIzaSyBl1rCI_oEGNUiGhV6XRXCgnhEV2fUM-PY
        $vid = $request['url'];
        parse_str( parse_url( $vid, PHP_URL_QUERY ), $my_array_of_vars );
        if(isset($my_array_of_vars['v'])){
            $vid = $my_array_of_vars['v'];
        }
        else{
            $error_msg = "Incorrect URL!";
            return redirect()->back()->with('status', 'Incorrect URL!');
        }
        $time = self::getYoutubeDuration($vid);

        $data = self::getYTdata($request['url']);

        Song::create([
            'playlist_id' => $id,
            'title' => $data['title'],
            'duration' => gmdate("H:i:s", $time),
            'url' => $request['url']
        ]);
        return redirect()->back();
    }

    public function getYoutubeDuration($vid) {
        //$vid - YouTube video ID. F.e. LWn28sKDWXo
        $videoDetails = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$vid."&part=contentDetails,statistics&key=AIzaSyBl1rCI_oEGNUiGhV6XRXCgnhEV2fUM-PY");
        $VidDuration = json_decode($videoDetails, true);
        foreach ($VidDuration['items'] as $vidTime)
        {
          $VidDuration = $vidTime['contentDetails']['duration'];
        }
        if(preg_match('/H/',$VidDuration)){
            $pattern='/PT(\d+)H(\d+)M(\d+)S/';
        }
        else{
            $pattern='/PT(\d+)M(\d+)S/';
        }
        preg_match($pattern,$VidDuration,$matches);
        if(isset($matches[3])){
            $seconds=($matches[3]*60*60)+$matches[1]*60+$matches[2];
        }
        else{
            $seconds=$matches[1]*60+$matches[2];
        }
        return $seconds;
    }

    public function getYTdata($url){
        $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function deleteSong($id)
    {
        DB::table('songs')
        ->where('id', $id)
        ->delete();
        return redirect()->back();
    }
}
