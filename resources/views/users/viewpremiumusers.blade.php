@extends('layouts.app')

@php

    //phpinfo();

@endphp

@section('page_css')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/multi-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/star-rating.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/krajee-fa/theme.css') }}" media="all" type="text/css"/>
@endsection

@section('content')

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  @if (session()->has('success_message'))
    <div class="alert alert-success">
           {{ session('success_message') }}

    </div>
@endif

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">VIEW PREMIUM USER SECTION</h3>
        </div>
        <div class="section-body" id="app">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-md-12">
               
                                        <div class="clearfix"></div>
                                        <br>


                                        @if ($premium == 1)
                                        <h3>PREMIUM USER</h3>
                                        RATINGS
                                        <div class="">
                                            
                                           
                                           @for ($i=0;$i<$ratings[0]->rating;$i++)
                                             <i class="fas fa-star"></i>

                                           @endfor
                                           
                                        </div>
                                        <BR>
                                        OPINIONS
                                        <div class="">
                                          <ul>
                                          @foreach($opinions as $opinion)
                                            <li>{{ $opinion->comment }}</li>

                                          @endforeach
                                          </ul>
                                        </div>
                                        <BR>


                                        @else 
                                        <h3>NOT A PREMIUM USER</h3>
                                        @endif

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


   

@endsection

@section('page_js')
    <script src="{{ asset('assets/js/multi-form.js') }}"></script>
    <script src="{{ asset('assets/js/star-rating.min.js') }}"></script>
    <script src="{{ asset('themes/krajee-fa/theme.js') }}" type="text/javascript"></script>

    <script>
        $("#opinion-form").multiStepForm({}).navigateTo(0);
    </script>

 
@endsection

