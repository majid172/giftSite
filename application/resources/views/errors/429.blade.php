@extends('errors.layout')

@section('title', 'Too Many Requests')
@section('code', '429')
@section('message', 'Too Many Requests')

@section('icon')
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 mx-auto opacity-50">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
@endsection

@section('description')
You have made too many requests in a short period of time. Please wait a moment before trying again.
@endsection
