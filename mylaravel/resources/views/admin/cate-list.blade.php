@extends('layout.adminindex')
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
			分类管理
		</nav>
		<div class="Hui-article">
			<article class="cl pd-20">
				<div class="text-c">
					<h3>分类列表</h3>

				</div>
				<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				<a class="btn btn-primary radius" data-title="添加资讯" href="{{url('admin/category/create')}}"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
				</span>
				</div>
				<div class="mt-20">
					<table class="table table-border table-bordered table-bg table-hover table-sort">
						<thead>
						<tr class="text-c">
							<th width="50">排序</th>
							<th width="80">ID</th>
							<th width="120">分类</th>
							<th width="120">标题</th>
							<th width="80">查看次数</th>
							<th>描述</th>
							<th width="120">操作</th>
						</tr>
						</thead>
						@foreach($data as $d)
						<tbody>
						<tr class="text-c">
							<td><input title="" class="input-text"  width="30px" type="text" onchange="changeorder(this,{{$d->cate_id}})" value="{{$d->cate_order}}"/></td>
							<td>{{$d->cate_id}}</td>
							<td class="text-l"><u style="cursor:pointer" class="text-primary" title="查看"></u>{{$d->_cate_name}}</td>
							<td>{{$d->cate_title}}</td>
							<td>{{$d->cate_view}}</td>
							<td>{{$d->cate_description}}</td>
							<td class="f-14 td-manage">
								<a style="text-decoration:none; font-size: 20px;" class="ml-5"  href="{{url('admin/category/'.$d->cate_id.'/edit')}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none; font-size: 20px;" class="ml-5" onClick="article_del({{$d->cate_id}})" href="javascript:" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
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


        function article_del(cate_id){
            layer.confirm('确认要删除吗？', {
                btn:['确定','取消']
            }, function () {
                $.post("{{url('admin/category')}}/"+cate_id, {'_method':'delete','_token':"{{csrf_token()}}"},function (data){
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
	<script>
        function changeorder(obj,cate_id) {
            var cate_order=$(obj).val();
            $.post("{{url('admin/category/changeorder')}}",{'_token':"{{csrf_token()}}",'cate_id':cate_id,'cate_order':cate_order},function (data) {
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


