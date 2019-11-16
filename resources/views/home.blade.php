@extends('layouts.app')

@section('content')
@if (Auth::user()->leader == 1)
<works-admin-component></works-admin-component>
@else
<works-component></works-component>
@endif
@endsection
