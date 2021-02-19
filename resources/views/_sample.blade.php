
@extends('layouts.master')
@section('main_content')

@endsection




<?php 

return redirect()->route('education')->with(session()->flash('alert-success', 'Header data is saved successfully!'));

return redirect()->back()->with(session()->flash('alert-danger', 'This email is already registered.'));