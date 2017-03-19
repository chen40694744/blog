<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/new.css')}}" rel="stylesheet">
    <link href="{{asset('/home/css/style.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/home/js/modernizr.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($nav as $n=>$v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach </nav>
</header>


@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($new_art as $ne)
            <li><a href="{{url('a/'.$ne->art_id)}}" title="{{$ne->art_title}}" target="_blank">{{$ne->art_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($art as $t)
            <li><a href="{{url('a/'.$t->art_id)}}" title="{{$t->art_title}}" target="_blank">{{$t->art_title}}</a></li>
        @endforeach
    </ul>
@show

<footer>
    <p>{!! Config::get('web.copyright') !!}  {!! Config::get('web.web_count') !!}</p>
</footer>
</body>
</html>