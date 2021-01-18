<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'status' => 'SUCCESS',
            'comments' => $comment
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:comments',

        ]);
        $comment = new comment();
        $comment->name = $request->name;
        if ($comment->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "comment add successfully"
            ]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $comment = comment::find($id);
        if ($comment) {
            return response()->json([
                'status' => 'SUCCESS',
                'comment' => $comment
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|',
        ]);

        $comment = comment::find($id);
        if ($comment) {
            $comment->name = $request->name;
            if ($comment->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => "comment Update successfully"
                ]);
            }
        }

    }




    public function active($id)
    {
        $comment = comment::find($id);
        if ($comment) {
            $comment->status = 1;
            if ($comment->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'comment active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $comment = comment::find($id);
        if ($comment) {
            $comment->status = 0;
            if ($comment->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'comment de-active successfully'
                ]);
            }
        }
    }

    public  function destroy($id){
        $comment = comment::find($id);
        if ($comment) {
            if ($comment->delete()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'comment delete successfully'
                ]);
            }
        }
    }
}
