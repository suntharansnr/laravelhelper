<ul class="nested" id="nested">
@foreach($childs as $child)
	<li class="mt-3" id="liselect{{$child->id}}"><span class="caret"></span>
	    {{ $child->name }} <a role="button" href="" class="btn btn-primary btn-sm createCategory" data-toggle="modal" data-id="{{$child->id}}" data-name="{{$child->name}}" data-backdrop="static" data-keyboard="false" id="createNewcategory"><i class="fa fa-plus"></i></a>
                                <a href="javascript:void(0)" class="btn btn-warning btn-sm editUser" data-toggle="tooltip" data-id="{{$child->id}}" data-name="{{$child->name}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$child->id}}" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-times"></i></a>
	    @if(count($child->childs))
            @include('admin.category.manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>