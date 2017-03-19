@extends('layout.adminindex')
@section('content')
	<div class="dislpayArrow hidden-xs">
		<a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
	</div>

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a href="{{url('admin/index')}}" class="maincolor">首页</a>
			<span class="c-gray en">&gt;</span>
			资讯管理
			<span class="c-gray en">&gt;</span>
			文章管理
		</nav>
		<div class="Hui-article">
			<article class="cl pd-20">
				<div class="text-c">
					<h3>文章列表</h3>

				</div>
				<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				<a class="btn btn-primary radius" data-title="添加资讯" href="{{url('admin/article/create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a>
				</span>
				</div>
				<div class="mt-20">
					<table class="table table-border table-bordered table-bg table-hover table-sort">
						<thead>
						<tr class="text-c">
							<th width="80">ID</th>
							<th>标题</th>
							<th width="80">编辑</th>
							<th width="120">发布时间</th>
							<th width="75">浏览次数</th>
							<th width="120">操作</th>
						</tr>
						</thead>
						<tbody>
						@foreach($data as $d)
						<tr class="text-c">
							<td>{{$d->art_id}}</td>
							<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看"></u>{{$d->art_title}}</td>
							<td>{{$d->art_editor}}</td>
							<td>{{date('Y-m-d',$d->art_time)}}</td>
							<td>{{$d->art_view}}</td>
							<td class="f-14 td-manage">
								<a style="text-decoration:none; font-size: 20px;" class="ml-5"  href="{{url('admin/article/'.$d->art_id.'/edit')}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none; font-size: 20px;" class="ml-5" onClick="article_del({{$d->art_id}})" href="javascript:" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="page">{{$data->links()}}</div>

				</div>
			</article>
		</div>
	</section>



	<!--请在下方写此页面业务相关的脚本-->

	<script type="text/javascript">


		/*资讯-添加*/

		/*资讯-编辑*/

		/*资讯-删除*/
        function article_del(art_id){
            layer.confirm('确认要删除吗？', {
                btn:['确定','取消']
            }, function () {
                $.post("{{url('admin/article')}}/"+art_id, {'_method':'delete','_token':"{{csrf_token()}}"},function (data){
                    if(data.status==0){
                        layer.msg(data.msg,{icon:6});
                        location.replace(location.href);
                    }else{
                        layer.msg(data.msg,{icon:5});
                    }
				});

            },function () {


            })

        }

	</script>
<style>
	.page{ margin:20px 0 0 0; text-align:center; width:100%;overflow: hidden;}
	.page a b {color: #999;}
	.page>b,.page a {margin: 0 2px;height: 26px;line-height: 26px;border-radius: 50%;width: 26px;text-align: center;display: inline-block}
	.page a {margin: 0 2px;height: 26px;line-height: 26px;border-radius: 50%;width: 26px;text-align: center;display: inline-block}/* 针对IE6 */
	.page>b,.page a:hover{background: #333;color: #FFF;}
	.page a {color: #F33;border: #999 1px solid;}
	.page li {display: inline-block;}
</style>
@endsection


