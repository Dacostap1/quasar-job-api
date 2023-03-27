<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use App\Http\Resources\JobResource;

class JobController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    try {
      $jobs = Job::orderBy('created_at', 'desc')->paginate(
        $perPage = request('itemsPerPage'),
        $columns = ['*'],
        $pageName = 'page',
        $page =  request('page'),
      )->appends(request()->except('page'));

      return JobResource::collection($jobs);
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
      'title' => 'required',
      'company' => 'required',
      'description' => 'required',
      'salary' => 'required',
      'tag' => 'tag',
    ], []);


    try {

      $job = new Job();
      $job->title = $request->title;
      $job->company = $request->company;
      $job->description = $request->description;
      $job->salary = $request->salary;
      $job->tag = 'any tag';

      $job->save();

      return response()->json(['success' => 'OK'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Job $job)
  {
    try {

      $job = Job::withCount('applications')->get();

      return response()->json(['success' => 'OK', 'job' => $job], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 400);
    }
  }



  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Job $job)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Job $job)
  {
    //
  }
}
