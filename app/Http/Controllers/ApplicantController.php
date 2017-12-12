<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Applicant;
use App\Category;
use App\Skill;
use App\Job;

class ApplicantController extends Controller
{
  /**
  * GET /
  */
  public function index()
  {
      $applicants = Applicant::orderBy('last_name')->get();

      return view('applicant.index')->with([
          'applicants' => $applicants,
      ]);
  }


  /**
  * GET /applicant/{$id}
  */
  public function show($id)
  {
      $applicant = Applicant::find($id);
      $localStates = array('MI', 'Mi', 'Michigan');
      if (in_array($applicant->state, $localStates)) {
        $localOrRelocatable = 'Local Applicant';
      }
      elseif ($applicant->can_relocate == 0) {
          $localOrRelocatable = 'Willing to relocate if required.';
      } else {
          $localOrRelocatable = 'Can not relocate, Only accespting remote work.';
      };
      if ($applicant->experience == 1) {
          $experience = $applicant->experience.' '.'year';
      } else {
          $experience = $applicant->experience.' '.'years';
      };
      if (!$applicant) {
          return redirect('/applicant')->with('alert', 'Applicant not found');
      }
      return view('applicant.show')->with([
          'applicant' => $applicant,
          'localOrRelocatable' => $localOrRelocatable,
          'experience' => $experience
      ]);
  }


  /**
  * GET /applicant/create
  */
  public function create()
  {
      $skillsForChosenSelect = Skill::getForChosenSelect();
      return view('applicant.create')->with([
          'skillsForChosenSelect' => $skillsForChosenSelect
      ]);
  }


  /**
  * POST /applicant
  */
  public function store(Request $request)
  {

      $this->validate($request, [
          'last_name' => 'required|max:191',
          'first_name' => 'required|max:191',
          'experience' => 'required|numeric|min:0|max:100',
          'address_line_1' => 'required|max:191',
          'address_line_2' => 'required|max:191',
          'city' => 'required|max:191',
          'state' => 'required|max:191',
          'zip' => 'required|numeric',
          'phone' => 'required|max:191',
          'email' => 'required|email',
          'skills' => 'required',
      ]);

      # Add new applicant to the database

      $applicant = new Applicant();
      $applicant->last_name = $request->input('last_name');
      $applicant->first_name = $request->input('first_name');
      $applicant->experience = $request->input('experience');
      $applicant->address_line_1 = $request->input('address_line_1');
      $applicant->address_line_2 = $request->input('address_line_2');
      $applicant->address_line_3 = $request->input('address_line_3');
      $applicant->city = $request->input('city');
      $applicant->state = $request->input('state');
      $applicant->zip = $request->input('zip');
      $applicant->can_relocate = ($request->input('can_relocate') == 'on' ? 1 : 0);
      $applicant->phone = $request->input('phone');
      $applicant->email = $request->input('email');

      $applicant->save();
      $applicant->skills()->sync($request->input('skills'));

      return redirect('/applicant')->with('alert', 'The applicant '.$request->input('last_name').', '.$request->input('first_name').' was added.');
  }


  /*
  * GET /applicant/{id}/edit
  */
  public function edit($id)
  {
      $applicant = Applicant::find($id);
      $categoriesForDropdown = Category::getForDropdown();
      $skillsForChosenSelect = Skill::getForChosenSelect();
      $skillIdsForThisApplicant = $applicant->skills->pluck('id')->all();
      if (!$applicant) {
          return redirect('/applicant')->with('alert', 'Applicant not found');
      }

      return view('applicant.edit')->with([
        'applicant' => $applicant,
        'categoriesForDropdown' => $categoriesForDropdown,
        'skillsForChosenSelect' => $skillsForChosenSelect,
        'skillIdsForThisApplicant' => $skillIdsForThisApplicant
      ]);
  }


  /*
  * PUT /applicant/{id}
  */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'last_name' => 'required|max:191',
      'first_name' => 'required|max:191',
      'experience' => 'required|numeric|min:0|max:100',
      'address_line_1' => 'required|max:191',
      'address_line_2' => 'required|max:191',
      'city' => 'required|max:191',
      'state' => 'required|max:191',
      'zip' => 'required|numeric',
      'phone' => 'required|max:191',
      'email' => 'required|email',
      'skills' => 'required',
    ]);

    $applicant = Applicant::find($id);
    $applicant->skills()->sync($request->input('skills'));

    $applicant->last_name = $request->input('last_name');
    $applicant->first_name = $request->input('first_name');
    $applicant->experience = $request->input('experience');
    $applicant->address_line_1 = $request->input('address_line_1');
    $applicant->address_line_2 = $request->input('address_line_2');
    $applicant->address_line_3 = $request->input('address_line_3');
    $applicant->city = $request->input('city');
    $applicant->state = $request->input('state');
    $applicant->zip = $request->input('zip');
    $applicant->can_relocate = ($request->input('can_relocate') == 'on' ? 1 : 0);
    $applicant->phone = $request->input('phone');
    $applicant->email = $request->input('email');

    $applicant->save();

    return redirect('/applicant/'.$id)->with('alert', 'Your changes were saved.');
  }

  /*
  * GET /applicant/{id}/delete
  */
  public function confirmDeletion($id)
  {
      $applicant = Applicant::find($id);
      $localStates = array('MI', 'Mi', 'Michigan');
      if (in_array($applicant->state, $localStates)) {
        $localOrRelocatable = 'Local Applicant';
      }
      elseif ($applicant->can_relocate == 0) {
          $localOrRelocatable = 'Willing to relocate if required.';
      } else {
          $localOrRelocatable = 'Can not relocate, Only accespting remote work.';
      };
      if ($applicant->experience == 1) {
          $experience = $applicant->experience.' '.'year';
      } else {
          $experience = $applicant->experience.' '.'years';
      };

      return view('applicant.delete')->with([
          'applicant' => $applicant,
          'localOrRelocatable' => $localOrRelocatable,
          'experience' => $experience
      ]);
  }


  /*
  * DELETE /applicant/{id}
  */
  public function delete(Request $request, $id)
  {

      $applicant = Applicant::find($id);
      $applicant->skills()->detach();
      $applicant->delete();

      return redirect('/applicant')->with('alert', 'The applicant has been deleted.');
  }
  /**
  * GET /applicant/matchingjobs/{id}
  */
  public function matchingjobs($id)
  {
      $applicant = Applicant::find($id);
      $jobs = Job::all();
      if ($applicant->can_relocate == 0 || in_array($applicant->state, array('MI', 'Mi', 'Michigan'))) {
          $filtered = $jobs;
      } else {
      $filtered = $jobs->filter(function ($value) {
          return $value->only_local == 0;
        });
      };
    foreach ($filtered as $match) {
        $skillsMatch=count($applicant->skills->intersect($match->skills))/count($applicant->skills)*50;
        $expMatch=$applicant->experience/$match->min_exp*50;
        $totalMatch=($skillsMatch > 50 ? 50 : $skillsMatch) + ($expMatch > 50 ? 50 : $expMatch);
        $matchingJobs[$totalMatch] = $match;
    }
    krsort($matchingJobs);
    return view('applicant.matchingjobs')->with([
        'matchingjobs' => $matchingJobs,
    ]);
  }
}
