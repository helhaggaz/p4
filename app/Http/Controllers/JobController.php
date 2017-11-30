<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Job;

class JobController extends Controller
{
  /**
  * GET /
  */
  public function index()
  {
      $jobs = Job::join('categories', 'category_id', '=', 'categories.id')
        ->orderBy('title')->get();

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

      if (!$job) {
          return redirect('/job')->with('alert', 'Job not found');
      }

      return view('job.show')->with([
          'job' => $job
      ]);
  }


  /**
  * GET /job/create
  */
  public function create()
  {
      return view('job.create');
  }


  /**
  * POST /job
  */
  public function store(Request $request)
  {
      $this->validate($request, [
          'title' => 'required|min:3|max:191',
          'description ' => 'max:191',
          'category_id' => 'required',
          'only_local' => 'required',
          'min_exp' => 'required|numeric|min:0|max:100',
          'skills' => 'required',
      ]);

      # Add new book to the database
      $book = new Book();
      $book->title = $request->input('title');
      $book->author = $request->input('author');
      $book->published = $request->input('published');
      $book->cover = $request->input('cover');
      $book->purchase_link = $request->input('purchase_link');
      $book->save();

      return redirect('/book')->with('alert', 'The book '.$request->input('title').' was added.');
  }


  /*
  * GET /book/{id}/edit
  */
  public function edit($id)
  {
      $book = Book::find($id);

      if (!$book) {
          return redirect('/book')->with('alert', 'Book not found');
      }

      return view('book.edit')->with(['book' => $book]);
  }


  /*
  * PUT /book/{id}
  */
  public function update(Request $request, $id)
  {
      $this->validate($request, [
          'title' => 'required|min:3',
          'author' => 'required',
          'published' => 'required|min:4|numeric',
          'cover' => 'required|url',
          'purchase_link' => 'required|url',
      ]);

      $book = Book::find($id);

      $book->title = $request->input('title');
      $book->author = $request->input('author');
      $book->published = $request->input('published');
      $book->cover = $request->input('cover');
      $book->purchase_link = $request->input('purchase_link');
      $book->save();

      return redirect('/book/'.$id.'/edit')->with('alert', 'Your changes were saved.');
  }

  /*
  * GET /book/{id}/delete
  */
  public function confirmDeletion($id)
  {
      $book = Book::find($id);

      if (!$book) {
          return redirect('/book')->with('alert', 'Book not found');
      }

      return view('book.delete')->with(['book' => $book]);
  }


  /*
  * DELETE /book/{id}
  */
  public function delete(Request $request, $id)
  {

      $book = Book::find($id);

      $book->delete();

      return redirect('/book')->with('alert', 'The book has been deleted.');
  }

}
