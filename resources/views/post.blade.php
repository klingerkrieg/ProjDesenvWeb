@extends('layouts.template')

@section('content')

    @if($post)

    <h2>{{$post->subject}}</h2>
    <span style="float:right;">{{$post->publish_date->format('d/m/Y')}}</span>
    <br/>
    <img src="{{asset($post->image)}}" width="400px">

    <p>{{$post->text}}</p>

    @endif


@endsection

