@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    header("Location: /user/login");
    die();
@endphp

@include($activeTemplate.'sections.banner')

@if($sections->secs != null)
@foreach(json_decode($sections->secs) as $sec)
    @include($activeTemplate.'sections.'.$sec)
@endforeach
@endif

@endsection