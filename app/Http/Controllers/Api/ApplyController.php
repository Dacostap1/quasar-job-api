<?php

namespace App\Http\Controllers\Api;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplyResource;

class ApplyController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    try {

      $applys = Apply::with('job')->where('user_id', auth()->user()->id)->paginate(
        $perPage = request('itemsPerPage'),
        $columns = ['*'],
        $pageName = 'page',
        $page =  request('page'),
      )->appends(request()->except('page'));

      return ApplyResource::collection($applys);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'file' => 'required',
      'description' => 'required',
      'job_id' => 'required',
    ], []);

    try {

      $apply = new Apply();
      $apply->file = $request->file;
      $apply->description = $request->description;
      $apply->user_id =
        auth()->user()->id;
      $apply->job_id = $request->job_id;


      $apply->save();

      return response()->json(['success' => 'OK'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Apply $apply)
  {
    //
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Apply $apply)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Apply $apply)
  {
    //
  }
}
