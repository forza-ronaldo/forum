<?php

namespace App\Http\Controllers\API;

use App\Channels;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class channelController extends Controller
{
    public function index()
    {
        return ChannelResource::collection(Channels::all());
    }
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),
        [
           'title'=>'required|unique:channels'
        ]);
        if($validate->fails()){
            return  response()->json([
                'error'=>true,
                'errors'=>$validate->errors(),
            ],422);
        }
        $channel=Channels::create([
            'title'=>$request->title
        ]);
        return new  ChannelResource($channel);
    }
    public function show( $channelName)
    {
        return new ChannelResource(Channels::whereTitle($channelName)->firstOrFail());
    }
    public function update(Request $request, Channels $channel)
    {
        $validate=Validator::make($request->all(),
            [
                'title'=>'required|unique:channels'
            ]);
        if($validate->fails()){
            return  response()->json([
                'error'=>true,
                'errors'=>$validate->errors(),
            ],422);
        }
        $channel->update($request->all());
        return new ChannelResource($channel);

    }
    public function destroy(Channels $channel)
    {
        $channel->delete();
        return response()->json([
            'error'=>false,
            "message"=>" the channel name is : $channel->tilte successfully been deleted"
        ],200);
    }
}
