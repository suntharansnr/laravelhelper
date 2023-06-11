<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $property_id = $request->property_id;
    	$request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        Comment::create($input);
        return response()->json([
                                   'fail' => false,
                                   'redirect_url' => url('view/'.$property_id)
                               ]);
    }

    public function delete($id)
    {
      $child_comment = Comment::where('parent_id','=',$id)->get();
      if ($child_comment->count() != '0')
            {
              foreach ($child_comment as $key => $value) {
                $value->delete();
              }
            }
      $comment = Comment::find($id);
      $comment->delete();
      return response()->json();
    }

    public function edit($id)
    {
      $comment = Comment::find($id);
      return response()->json($comment);
    }

    public function update(Request $request)
    {
      $comment = Comment::find($request->id);
      $comment->body = $request->body;
      $comment->update();
      return response()->json();
    }

}
