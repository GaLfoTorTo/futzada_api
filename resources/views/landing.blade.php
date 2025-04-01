@extends('layout.app')
@section('content')
   <div id="app" data-bs-spy="scroll" data-bs-target="#navbar">
      @include('sections.home')
      @include('sections.usability')
      @include('sections.features')
      @include('sections.network')
      @include('sections.modality')
      @include('sections.download')
   </div>
@endsection