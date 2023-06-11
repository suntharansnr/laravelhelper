<?php

namespace App\Http\Controllers;
use App\Metatag;
use Auth;
use DataTables;
use DB;
use Route;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    function __construct()
        {
             $this->middleware('permission:meta-list|meta-create|meta-edit|meta-delete', ['only' => ['index','store']]);
             $this->middleware('permission:meta-create', ['only' => ['create','store']]);
             $this->middleware('permission:meta-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:meta-delete', ['only' => ['destroy']]);
             $this->middleware('permission:meta-status', ['only' => ['Status_Update']]);
        }
  public function index(Request $request)
  {
      $routeName = Route::currentRouteName();
      $meta_tag = metatag::where('route', '=', $routeName)->firstOrFail();
      if ($request->ajax()) {
          $data = Metatag::latest()->get();
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="btn btn-warning btn-sm editTheme" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"><i class="fa fa-edit"></i></a>';
                        return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
      }
      if (!Auth::user()->isAdmin()) {
          return view('admin.users.accessdenied',compact('meta_tag'));
      }
      else {
          return view('admin.meta.meta',compact('meta_tag'));
      }
  }

  public function store(Request $request)
  {
      Metatag::updateOrCreate(['id' => $request->id],
              ['title' => $request->title,
               'description' => $request->description,
               'keywords' => $request->keywords,
               'author' => $request->author,
               'canonical' => $request->canonical,
               'og:url' => $request->og_url,
               'og:image' => $request->og_image,
               'og:description' => $request->og_description,
               'og:title' => $request->og_title,
               'og:site_name' => $request->og_site_name,
               'og:see_also' => $request->og_see_also,
               'name' => $request->name,
               'googledescription' => $request->googledescription,
               'description' => $request->description,
               'image' => $request->image,
               'twitter:card' => $request->twitter_card,
               'twitter:url' => $request->twitter_url,
               'twitter:title' => $request->twitter_title,
               'twitter:description' => $request->twitter_description,
               'twitter:image' => $request->twitter_image,
             ]);
      return response()->json(['success'=>'Meta details updated successfully.']);
  }

  public function edit($id)

  {
      $Metatag = Metatag::find($id);
      return response()->json($Metatag);
  }
}