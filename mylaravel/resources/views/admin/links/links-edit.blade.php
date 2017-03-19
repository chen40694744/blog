@extends('layout.adminindex')
@section('content')

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="{{url('admin/index')}}" class="maincolor">首页</a> <span class="c-999 en">&gt;</span>
			<span class="c-666">资讯管理</span><span class="c-999 en">&gt;</span>
			<span class="c-666">友情链接修改</span></nav>
		<div class="Hui-article">
			<article class="cl pd-20">
		<form class="form form-horizontal" id="form-article-add" action="{{url('admin/links/'.$field->link_id)}}" method="post">
			<input type="hidden" name="_method" value="put">
			{{csrf_field()}}
			<div style="width: 70%; margin: auto"  >
				@if(count($errors)>0)
					@if(is_object($errors))
						@foreach($errors->all() as $error)
							<span class="c-red">{{$error}}</span>
						@endforeach
					@else
						<span class="c-red">{{$error}}</span>
					@endif
				@endif

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接名称：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="{{$field->link_name}}" placeholder="" id="" name="link_name">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接标题：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="{{$field->link_title}}" placeholder="" id="" name="link_title">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">排序值：</label>
					<div class="formControls col-xs-1">
						<input type="text" class="input-text" value="{{$field->link_ord}}" placeholder="" id="" name="link_ord" width="30px">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>链接地址：</label>
					<div class="formControls col-xs-6">
						<input type="text" class="input-text" value="{{$field->link_url}}" placeholder="" id="" name="link_url">
					</div>
				</div>


				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
						<button class="btn btn-default radius" onclick="history.go(-1)" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
		</form>
	</article>
		</div>
	</section>

@endsection



