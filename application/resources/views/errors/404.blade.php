@extends('errors.layout')

@section('title', 'Page Not Found')
@section('code', '404')
@section('message', 'Page Not Found')

@section('icon')
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 mx-auto opacity-50">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
</svg>
@endsection

@section('description')
The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
@endsection
