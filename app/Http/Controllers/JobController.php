<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Job;
use App\Category;
use App\Skill;
use App\Applicant;

class JobController extends Controller
{
  /**
  * GET /
  */
  public function index()
  {
      $jobs = Job::orderBy('title')->get();

      return view('job.index')->with([
          'jobs' => $jobs,
      ]);
  }


  /**
  * GET /job/{$id}
  */
  public function show($id)
  {
      $job = Job::find($id);
      if ($job->only_local == 0) {
          $requireRelocation = 'Local applicants prefered and non-local would be required to relocate.';
      } else {
          $requireRelocation = 'Local and non-local applicants are welcomed for this job.';
      };
      if ($job->min_exp == 1) {
          $minmumExperience = $job->min_exp.' '.'year';
      } else {
          $minmumExperience = $job->min_exp.' '.'years';
      };
      if (!$job) {
          return redirect('/job')->with('alert', 'Job not found');
      }
      return view('job.show')->with([
          'job' => $job,
          'requireRelocation' => $requireRelocation,
          'minmumExperience' => $minmumExperience
      ]);
  }


  /**
  * GET /job/create
  */
  public function create()
  {
      $categoriesForDropdown = Category::getForDropdown();
      $skillsForChosenSelect = Skill::getForChosenSelect();
      return view('job.create')->with([
          'categoriesForDropdown' => $categoriesForDropdown,
          'skillsForChosenSelect' => $skillsForChosenSelect
      ]);
  }


  /**
  * POST /job
  */
  public function store(Request $request)
  {

      $this->validate($request, [
          'title' => 'required|min:3|max:191',
          'description ' => 'max:191',
          'category' => 'required',
          'min_exp' => 'required|numeric|min:0|max:100',
          'skills' => 'required',
      ]);

      # Add new job to the database

      $job = new Job();
      $job->title = $request->input('title');
      $job->description = $request->input('description');
      $job->category_id = $request->input('category');
      $job->only_local = ($request->input('only_local') == 'on' ? 1 : 0);
      $job->min_exp = $request->input('min_exp');

      $job->save();
      $job->skills()->sync($request->input('skills'));

      return redirect('/job')->with('alert', 'The job '.$request->input('title').' was added.');
  }


  /*
  * GET /job/{id}/edit
  */
  public function edit($id)
  {
      $job = Job::find($id);
      $categoriesForDropdown = Category::getForDropdown();
      $skillsForChosenSelect = Skill::getForChosenSelect();
      $skillIdsForThisJob = $job->skills->pluck('id')->all();
      if (!$job) {
          return redirect('/job')->with('alert', 'Job not found');
      }

      return view('job.edit')->with([
        'job' => $job,
        'categoriesForDropdown' => $categoriesForDropdown,
        'skillsForChosenSelect' => $skillsForChosenSelect,
        'skillIdsForThisJob' => $skillIdsForThisJob
      ]);
  }


  /*
  * PUT /job/{id}
  */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
        'title' => 'required|min:3|max:191',
        'description ' => 'max:191',
        'category' => 'required',
        'min_exp' => 'required|numeric|min:0|max:100',
        'skills' => 'required',
    ]);

    $job = Job::find($id);
    #dd($request);
    $job->skills()->sync($request->input('skills'));

    $job->title = $request->input('title');
    $job->description = $request->input('description');
    $job->category_id = $request->input('category');
    $job->only_local = ($request->input('only_local') == 'on' ? 1 : 0);
    $job->min_exp = $request->input('min_exp');

    $job->save();


      return redirect('/job/'.$id)->with('alert', 'Your changes were saved.');
  }

  /*
  * GET /job/{id}/delete
  */
  public function confirmDeletion($id)
  {
      $job = Job::find($id);
      if ($job->only_local == 0) {
          $requireRelocation = 'Local applicants prefered and non-local would be required to relocate.';
      } else {
          $requireRelocation = 'Local and non-local applicants are welcomed for this job.';
      };
      if ($job->min_exp == 1) {
          $minmumExperience = $job->min_exp.' '.'year';
      } else {
          $minmumExperience = $job->min_exp.' '.'years';
      };
      if (!$job) {
          return redirect('/job')->with('alert', 'Job not found');
      }

      return view('job.delete')->with([
          'job' => $job,
          'requireRelocation' => $requireRelocation,
          'minmumExperience' => $minmumExperience
      ]);
  }


  /*
  * DELETE /job/{id}
  */
  public function delete(Request $request, $id)
  {

      $job = Job::find($id);
      $job->skills()->detach();
      $job->delete();

      return redirect('/job')->with('alert', 'The job has been deleted.');
  }
  /**
  * GET /job/matchingapplicants/{id}
  */
  public function matchingapplicants($id)
  {
      $job = Job::find($id);
      $applicants = Applicant::all();
      if ($job->only_local == 1) {
        $filtered = $applicants->filter(function ($value) {
            return in_array($value->state, array('MI', 'Mi', 'Michigan'));
      });
    } else {
      $filtered = $applicants;
    };
    foreach ($filtered as $match) {
        $skillsMatch=count($job->skills->intersect($match->skills))/count($job->skills)*50;
        $expMatch=$match->experience/$job->min_exp*50;
        $totalMatch=($skillsMatch > 50 ? 50 : $skillsMatch) + ($expMatch > 50 ? 50 : $expMatch);
        $matchingApplicants[$totalMatch] = $match;
    }
    krsort($matchingApplicants);
    return view('job.matchingapplicants')->with([
        'matchingapplicants' => $matchingApplicants,
    ]);
  }

}
