@extends('layouts.master')

@section('title')
    Edit applicant {{ $applicant->title }}
@endsection

@section('content')

    <h1>Edit applicant {{ $applicant->title }} </h1>
    <div class="container">
        <form method='POST' action='/applicant/{{ $applicant->id }}'>

            {{ method_field('put') }}

            {{ csrf_field() }}

            <div class='details'>* Required fields</div>
            <div class='form-group'>
                <label for='last_name'>* Last Name</label>
                <input type='text' name='last_name' id='last_name' value='{{ old('last_name', $applicant->last_name) }}'>
                @include('modules.error-field', ['fieldName' => 'last_name'])
                <label for='first_name'>* First Name</label>
                <input type='text' name='first_name' id='first_name' value='{{ old('first_name', $applicant->first_name) }}'>
                @include('modules.error-field', ['fieldName' => 'first_name'])
            </div>
            <div class='form-group'>
                <label for='can_relocate'><input type='checkbox' name='can_relocate' id='can_relocate' {{ (old('can_relocate', $applicant->can_relocate)==1) ? 'checked' : ''}}> Can Relocate if required ?</label>
            </div>
            <div class='form-group'>
                <label for='experience'>* Years of Experience </label>
                <input type='text' max='3' name='experience' id='experience' value='{{ old('experience', $applicant->experience) }}'>
                @include('modules.error-field', ['fieldName' => 'experience'])
            </div>
            <div class='form-group'>
                <label for='skills'>* Skills </label>
                <select class='form-control chosen-select'  multiple name='skills[]' id='skills'>
                    @foreach($skillsForChosenSelect as $id => $name)
                        <option value='{{ $id }}' {{ (isset($skillIdsForThisApplicant) and in_array($id,$skillIdsForThisApplicant)) ? 'SELECTED' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='form-group'>
                <label for='address_line_1'>* Address Line 1:</label>
                <input type='text' name='address_line_1' id='address_line_1' value='{{ old('address_line_1', $applicant->address_line_1) }}'>
                @include('modules.error-field', ['fieldName' => 'address_line_1'])
            </div>
            <div class='form-group'>
                <label for='address_line_2'>* Address Line 2:</label>
                <input type='text' name='address_line_2' id='address_line_2' value='{{ old('address_line_2', $applicant->address_line_2) }}'>
                @include('modules.error-field', ['fieldName' => 'address_line_2'])
            </div>
            <div class='form-group'>
                <label for='address_line_3'>Address Line 3:</label>
                <input type='text' name='address_line_3' id='address_line_3' value='{{ old('address_line_3', $applicant->address_line_3) }}'>
            </div>
            <div class='form-group'>
                <label for='city'>* City:</label>
                <input type='text' name='city' id='city' value='{{ old('city', $applicant->city) }}'>
                @include('modules.error-field', ['fieldName' => 'city'])
            </div>
            <div class='form-group'>
                <label for='state'>* State:</label>
                <input type='text' name='state' id='state' value='{{ old('state', $applicant->state) }}'>
                @include('modules.error-field', ['fieldName' => 'state'])
            </div>
            <div class='form-group'>
                <label for='zip'>* Zip:</label>
                <input type='text' name='zip' id='zip' value='{{ old('zip', $applicant->zip) }}'>
                @include('modules.error-field', ['fieldName' => 'zip'])
            </div>
            <div class='form-group'>
                <label for='phone'>* Phone:</label>
                <input type='text' name='phone' id='phone' value='{{ old('phone', $applicant->phone) }}'>
                @include('modules.error-field', ['fieldName' => 'phone'])
            </div>
            <div class='form-group'>
                <label for='email'>* Email:</label>
                <input type='text' name='email' id='email' value='{{ old('email', $applicant->email) }}'>
                @include('modules.error-field', ['fieldName' => 'email'])
            </div>
            <input type='submit' value='Save changes' class='btn btn-primary btn-small'>
            <input type="button" value='Cancel' class='btn btn-primary btn-small' onclick="history.back();" />
        </form>
    </div>
@endsection
