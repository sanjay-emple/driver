@extends('layouts.app')
@section('link')
@endsection
@section('content')
  <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">

            <div class="account-bg">
                <div class="card-box mb-0">
                    <div class="text-center m-t-20">
                        <a href="#" class="logo">
                            <span><img style="width:50%;" src="{{ url('public/assets/images/logo3.jpg') }}"></span>
                        </a>
                    </div>
                    <div class="m-t-10 p-20">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6 class="text-muted text-uppercase m-b-0 m-t-0"></h6>
                            </div>
                        </div>
                        @include('partials.flash')
                        <div class="jumbotron text-xs-center">
                          <h1 class="display-5">Thank You!</h1>
                          <p class="lead">You will be contacted shortly for further instructions and you will be able to login once your account is approved.</p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end card-box-->

        </div>
@endsection
