﻿@extends('layout.adminindex')
@section('content')
	<div class="dislpayArrow hidden-xs">
		<a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
	</div>
	<!--/_menu 作为公共模版分离出去-->

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a href="{{url('admin/index')}}" class="maincolor">首页</a>
			<span class="c-gray en">&gt;</span>
			资讯管理
			<span class="c-gray en">&gt;</span>
			自定义导航管理
		</nav>
		<div class="Hui-article">
			<article class="cl pd-20">
				<div class="text-c">
					<h3>自定义导航列表</h3>

				</div>
				<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				<a class="btn btn-primary radius" data-title="添加资讯" href="{{url('admin/navbar/create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
				</span>
				</div>
				<div class="mt-20">
					<table class="table table-border table-bordered table-bg table-hover table-sort">
						<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="30">排序</th>
							<th width="30">ID</th>
							<th width="100">导航名称</th>
							<th width="150">导航标题</th>
							<th>导航地址</th>
							<th width="120">操作</th>
						</tr>
						</thead>
						@foreach($data as $d)
						<tbody>
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td class="text-l"><input class="input-text"  width="30px" type="text" onchange="changeorder(this,{{$d->nav_id}})" value="{{$d->nav_order}}"></td>
							<td>{{$d->nav_id}}</td>
							<td>{{$d->nav_name}}</td>
							<td>{{$d->nav_alias}}</td>
							<td>{{$d->nav_url}}</td>
							<td class="f-14 td-manage">
								<a style="text-decoration:none; font-size: 20px;" class="ml-5"  href="{{url('admin/navbar/'.$d->nav_id.'/edit')}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none; font-size: 20px;" class="ml-5" onClick="nav_del({{$d->nav_id}})" href="javascript:" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>

						</tbody>
							@endforeach
					</table>
				</div>
			</article>
		</div>
	</section>



	<!--请在下方写此页面业务相关的脚本-->

	<script type="text/javascript">
        function nav_del(nav_id){
            layer.confirm('确认要删除吗？', {
                btn:['确定','取消']
            }, function () {
                $.post("{{url('admin/navbar')}}/"+nav_id, {'_method':'delete','_token':"{{csrf_token()}}"},function (data){
                    if(data.status==0){
                        layer.msg(data.msg,{icon:6});
                        location.replace(location.href);
                    }else{
                        layer.msg(data.msg,{icon:5});
                    }
				});

            },function () {


            });
        }
	</script>
	<script>
        function changeorder(obj,nav_id) {
		var nav_order=$(obj).val();
		$.post("{{url('admin/navbar/changeorder')}}",{'_token':"{{csrf_token()}}",'nav_id':nav_id,'nav_order':nav_order},function (data) {
			if(data.status==0){
				layer.msg(data.msg,{icon:6});
                location.replace(location.href);
			}else {
                layer.msg(data.msg,{icon:5});
			}
        });
        }
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
@endsection


