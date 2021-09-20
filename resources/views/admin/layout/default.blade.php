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
    <title>@yield("title")</title>  
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css')}}" />
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
      background: rgba(14,120,133,255);
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

    @yield("sc_header")
  </head>
  <body class="">
    <div class="page">
      <div class="flex-fill">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="{{route('user.home')}}">
                <img src="{{asset('assets/images/logo.png')}}" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">                         
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url({{asset('assets/images/users/'.auth()->user()->photo)}})"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ucwords(auth()->user()->username)}}</span>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{route('user.profil')}}">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>                    
                    <div class="dropdown-divider"></div>                  
                    <a class="dropdown-item" href="{{route('logout')}}">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">             
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">                                  
                  <li class="nav-item">
                    <a href="{{route('admin.home')}}" class="nav-link">
                      <i class='fe fe-inbox'></i> 
                      Home
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.user')}}" class='nav-link'>
                      <i class='fe fe-user'></i>
                      User
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.product')}} " class="nav-link">
                      <i class='fe fe-list'></i> 
                      Lapangan
                    </a>
                  </li>                                  

                  <li class="nav-item">
                    <a href="{{route('admin.review')}}" class="nav-link">
                      <i class='fe fe-message-circle'></i> 
                      Review
                    </a>
                  </li>

                  <li class='nav-item'>
                    <a href="{{route('admin.invoice')}}" class='nav-link'>
                      <i class='fe fe-clipboard'></i> 
                      Invoice
                    </a>
                  </li>                

                  <li class="nav-item">
                    <a href="{{route('admin.manual-payment')}}" class="nav-link">
                      <i class='fe fe-dollar-sign'></i> 
                      Pembayaran Manual
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('admin.report')}}" class='nav-link'>
                      <i class='fe fe-file'></i> 
                      Laporan
                    </a>
                  </li>
                
                  <li class='nav-item'>
                    <a href="{{route('admin.setting')}}" class="nav-link">
                      <i class='fe fe-settings'></i> 
                      Setting
                    </a>
                  </li> 
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="my-3 my-md-5">
          @yield("content")
        </div>
      </div>        
    </div>

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
    
    @if(Session::has("comeback"))
      @if(Session::get("comeback")["message"] == "failed")
      <script>
        toastr.error("{{Session::get("comeback")["failed"]}}","");
      </script>
      @endif

      @if(Session::get("comeback")["message"] == "success")
      <script>
        toastr.success("{{Session::get("comeback")["success"]}}","");
      </script>
      @endif
    @endif

    @yield("sc_footer")
  </body>
</html>