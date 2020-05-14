<?php

namespace App\Http\Controllers\API;

use App\Discussion;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\ReplyResource;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class replyController extends Controller
{
    public function index()
    {
        return ReplyResource::collection(Reply::all());
    }
    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),
            [
                'text'=>'required',
            ]);
        if($validate->fails()){
            return  response()->json([
                'error'=>true,
                'errors'=>$validate->errors(),
            ],422);
        }
        $reply=Reply::create($request->only('discussion_id','user_id','text'));
        return new  ChannelResource($reply);
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
}
