@extends('vendor.eperpus.master')

@section('body')
  @include('vendor.eperpus.partials.nav')
  <main class="container py-4">
    @yield('content')
  </main>
@stop