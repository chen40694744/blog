@extends('layout.home_css_js')
@section('info')
    <title>{{$field->cate_name}}-{{Config::get('web.seo_title')}}</title>
    <meta name="keywords" content="{{$field->cate_keywords}}" />
    <meta name="description" content="{{$field->cate_description}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav_list"><span>{{$field->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('list/'.$field->cate_id)}}}" class="n2">{{$field->cate_name}}</a></h1>
        <div class="newblog left">
            @foreach($art_list as $at)
            <h2>{{$at->art_title}}</h2>
            <p class="dateview"><span>发布时间：{{date('Y-m-d',$at->art_time)}}</span><span>作者：{{$at->art_editor}}</span><span>分类：[<a href="{{url('list/'.$field->cate_id)}}">{{$field->cate_name}}</a>]</span></p>
            <figure><img @if($at->art_thumb)
                        src="{{url($at->art_thumb)}}"
                         @else
                             style="display: none;"
                         @endif
                ></figure>
            <ul class="nlist">
                <p>{{$at->art_description}}</p>
                <a title="{{$at->art_title}}" href="{{url('a/'.$at->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            <div class="line"></div>
            @endforeach

            <div class="blank"></div>

            <div class="page">
                {{$art_list->links()}}
            </div>
        </div>
        <aside class="right">
            @if($sub_menu->all())
            <div class="rnav">
                <ul>
                    @foreach($sub_menu as $k=>$sm)
                    <li class="rnav{{$k+1}}"><a href="{{url('list/'.$sm->cate_id)}}" target="_blank">{{$sm->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Baidu Button BEGIN -->
                <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                <!-- Baidu Button END -->
            <div class="news" style="float: left;">
                @parent
            </div>


        </aside>
    </article>
@endsection

