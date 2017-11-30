<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
* Jobs
*/
# Create a job
#Route::get('/job/create', 'JobController@create');
#Route::post('/job', 'jobController@store');

# Edit a job
#Route::get('/job/{id}/edit', 'JobController@edit');
#Route::put('/job/{id}', 'JobController@update');

# Delete a job
#Route::get('/job/{id}/delete', 'JobController@confirmDeletion');
#Route::delete('/job/{id}', 'JobController@delete');

# View all jobs
Route::get('/job', 'JobController@index');

# View a job
Route::get('/job/{id}', 'JobController@show');

# Search all jobs
#Route::get('/search', 'JobController@search');

/**
* Homepage
*/
Route::get('/', 'WelcomeController');

/**
* Debug
*/
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
        'Database defaultStringLength' => Illuminate\Database\Schema\Builder::$defaultStringLength,
    ];

    /*
    The following commented out line will print your MySQL credentials.
    Uncomment this line only if you're facing difficulties connecting to the
    database and you need to confirm your credentials. When you're done
    debugging, comment it back out so you don't accidentally leave it
    running on your production server, making your credentials public.
    */
    #$debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});
