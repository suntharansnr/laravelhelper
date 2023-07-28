@foreach($comments as $comment)
  <div class="contianer" @if($comment->parent_id != null) style="margin-left:5%;" @endif>
  <div class="row">
       <div class="col-md-2" style="">
          @if ($comment->user->User_Org_Image == null)
            <img src="{{asset("images/team/avataaars.png")}}" alt="" style="border-radius:50%;height:75px;width:75px;">
          @else
            <img src="{{asset($comment->user->User_Org_Image)}}" alt="" style="border-radius:50%;height:75px;width:75px;">
          @endif
       </div>
       <div class="col-md-10" style="padding-left:0px !important" style="height:auto">
         <div class="display-comment" style="">
             <strong>{{ $comment->user->First_Name }} Says <p class="float-right text-muted text-small" style="font-size:0.7rem">{{$comment->created_at}}</p> </strong>
             <p style="font-size:0.9rem;" class="text-muted">{{ $comment->body }}</p>
             <p>
                @if(Auth::check())
                  <a class="btn btn-info btn-sm reply" data-id="{{$comment->id}}" data-toggle="collapse" href="#reply{{$comment->id}}" role="button" aria-expanded="false" aria-controls="reply{{$comment->id}}"><i class="fa fa-reply"></i></a>
                @if (Auth::user()->id == $comment->user_id)
                  <a href="javascript:void(0)" class="btn btn-success btn-sm editcomment" data-toggle="tooltip" data-id="{{$comment->id}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                  <button type="button" name="button" class="btn btn-danger btn-sm deleteComment" role="button" data-id="{{$comment->id}}"><i class="fa fa-trash"></i></button>
                @endif
                @endif
             </p>
         </div>
       </div>

       <hr @if($comment->parent_id != null) style="margin-left:5%;" @endif>
       <div class="collapse multi-collapse" id="reply{{$comment->id}}" @if($comment->parent_id != null) style="margin-left:5%;" @endif>
         <div class="card card-body" style="border:none !important;padding:0px !important">
           <form id="replyfrm">
             <div class="form-group">
               <textarea name="body" class="form-control rounded-0" rows="5" cols="80" id="body{{$comment->id}}"></textarea>
               <input type="hidden" name="post_id" value="{{ $post_id }}" id="property_id{{$comment->id}}"/>
               <input type="hidden" name="parent_id" value="{{ $comment->id }}" id="parent_id{{$comment->id}}"/>
             </div>
             <div class="form-group">
               <button type="button"class="btn btn-info btn-small rounded-0 ajaxSubmit" id="ajaxSubmit" data-id="{{$comment->id}}">Post Comment</button>
             </div>
           </form>
         </div>
         <hr>
       </div>

      </div>
      @include('fronts.pages.comments', ['comments' => $comment->replies])
  </div>
@endforeach
