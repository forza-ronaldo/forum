<?php

namespace App\Http\Controllers\API;

use App\Channels;
use App\Discussion;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\DiscussionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class discussionController extends Controller
{
    public function index()
    {
        return DiscussionResource::collection(Discussion::all());
    }
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),
            [
                'title'=>'required|unique:discussions',
                'content'=>'required',
            ]);
        if($validate->fails()){
            return  response()->json([
                'error'=>true,
                'errors'=>$validate->errors(),
            ],422);
        }
        $discussion=Discussion::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'slug'=>str_replace(' ','-',trim($request->title,' ')),
            'user_id'=>$request->user_id,
            'channel_id'=>$request->channel_id
        ]);
        return new  ChannelResource($discussion);
    }
    public function show($slug)
    {
        return new DiscussionResource(Discussion::whereSlug($slug)->first());
    }
    public function update(Request $request, Discussion $discussion)
    {
        $validate=Validator::make($request->all(),
            [
                'title'=>'required|unique:discussions',
                'content'=>'required',
            ]);
        if($validate->fails()){
            return  response()->json([
                'error'=>true,
                'errors'=>$validate->errors(),
            ],422);
        }
        $discussion->update($request->all());
        return new DiscussionResource($discussion);
    }
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return response()->json([
            'error'=>false,
            "message"=>" the discussion name is : $discussion->tilte successfully been deleted"
        ],200);
    }
}
