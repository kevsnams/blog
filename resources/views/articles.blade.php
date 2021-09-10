@extends('layouts.default')

@section('content')
    {!! $article->body->getHtml() !!}
@endsection