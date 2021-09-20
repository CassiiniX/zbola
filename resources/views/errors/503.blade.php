<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{ asset('assets/images/logo-header.png') }}" type="image/x-icon"/>  
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo-header.png') }}" />    
    <title>Maintaince</title>      
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}"  />
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">  
    <style>
    .parsley-errors-list{
      color:red;
      list-style:none;
      padding-left:10px;
      padding-top:3px;    
      margin:0px;
      opacity: 0.8;
      font-size: 13px;
      text-align: right;
    }

    .btn-zbola{
      background: orange;
      border: 0px solid red;
      color:white;
      margin-left: 15px;
      margin-right: 15px;
      border-radius: 10px;
    }

    .btn-zbola:hover{
     color: rgba(14,120,133,255);
     background: white;     
    }
    </style>
  </head>
  <body class="bg-white text-center"> 

  @if(!config('app.isMobile'))
    <div class="col-5 m-auto">
      <img src="{{asset('assets/images/503.png')}}"
	     class="img-fluid mt-3">
    </div>
  @endif

  @if(config('app.isMobile'))
    <div class="col-11 m-auto">
      <img src="{{asset('assets/images/503.png')}}"
       class="img-fluid mt-3">
    </div>
  @endif

  <script src="{{ asset('assets/js/vendors/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/moment.js')}}"></script>
  <script src="{{ asset('assets/js/moment-with-locales.js')}}"></script>
  <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/js/toastr.min.js')}}"></script>
  <script src="{{ asset('assets/js/parsley.min.js')}}"></script> 
  <script src="{{ asset('assets/js/i18n/id.js')}}"></script> 
  <script src="{{ asset('assets/js/sweetalert2.min.js')}}"></script>    
  
  <script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register("{{asset('assets/js/service-worker.js')}}")
    .then((registration) => {        
      console.log('SUCCESS SW');
     }).catch(() => {    
      console.log('FAILED SW');
    });
  } else {
      console.log('NOT FOUND SW');
  }
  </script>
  </body>
</html>
