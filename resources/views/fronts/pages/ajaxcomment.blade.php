<div class="" style="border-top:2px solid #337ab7 !important">
<h4>{{$post->comments->count()}} Comments </h4>
<hr>
@include('fronts.pages.comments', ['post_id' => $post->id])
{{$comments->links()}}
</div>
