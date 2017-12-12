@extends('layouts.master')

@section('title')
    Edit job {{ $job->title }}
@endsection

@section('content')

    <h1>Edit job {{ $job->title }} </h1>
    <div class="container">
        <form method='POST' action='/job/{{ $job->id }}'>

            {{ method_field('put') }}

            {{ csrf_field() }}

            <div class='details'>* Required fields</div>
            <div class='form-group'>
                <label for='title'>* Title</label>
                <input type='text' name='title' id='title' value='{{ old('title', $job->title) }}'>
                @include('modules.error-field', ['fieldName' => 'title'])
            </div>
            <div class='form-group'>
                <label for='description'>Description</label>
                <textarea class='form-control' rows='5'  name='description' id='description' >{{ old('description', $job->description) }}</textarea>
                @include('modules.error-field', ['fieldName' => 'description'])
            </div>
            <div class='form-group'>
                <label for='only_local'><input type='checkbox' name='only_local' id='only_local' {{ (old('only_local', $job->only_local)==1) ? 'checked' : ''}}> Only Local Applicants</label>
                @include('modules.error-field', ['fieldName' => 'only_local'])
            </div>
            <div class='form-group'>
                <label for='min_exp'>* Minimum years of Experience </label>
                <input type='text' max='3' name='min_exp' id='min_exp' value='{{ old('min_exp', $job->min_exp) }}'>
                @include('modules.error-field', ['fieldName' => 'min_exp'])
            </div>
            <div class='form-group'>
                <label for='category'>* Job Category </label>
                <select name='category' id='category'>
                    <option value='' selected='selected' disabled='disabled'>Choose one...</option>
                    @foreach($categoriesForDropdown as $id => $name)
                        <option value='{{ $id }}' {{ (isset($job) and $id == $job->category->id) ? 'SELECTED' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='form-group'>
                <label for='skills'>* Required Skills </label>
                <select class='form-control chosen-select'  multiple name='skills[]' id='skills'>
                    @foreach($skillsForChosenSelect as $id => $name)
                        <option value='{{ $id }}' {{ (isset($skillIdsForThisJob) and in_array($id,$skillIdsForThisJob)) ? 'SELECTED' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <input type='submit' value='Save changes' class='btn btn-primary btn-small'>
            <input type="button" value='Cancel' class='btn btn-primary btn-small' onclick="history.back();" />
        </form>
    </div>
@endsection
