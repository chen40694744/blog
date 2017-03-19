@extends('layout.adminindex')
@section('content')

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="{{url('admin/index')}}" class="maincolor">首页</a> <span class="c-999 en">&gt;</span>
			<span class="c-666">咨询管理</span><span class="c-999 en">&gt;</span>
			<span class="c-666">添加分类</span></nav>
		<div class="Hui-article">
			<article class="cl pd-20">
		<form class="form form-horizontal" id="form-article-add" action="{{url('admin/category')}}" method="post">
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
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="" placeholder="" id="" name="cate_name">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类标题：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="" placeholder="" id="" name="cate_title">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>父级分类：</label>
					<div class="formControls col-xs-2"> <span class="select-box">
					<select title="" name="cate_pid" class="select">
						<option value="0">==全部栏目==</option>
						@foreach($pid as $d)
						<option value="{{$d->cate_id}}">{{$d->cate_name}}</option>
						@endforeach
					</select>
					</span> </div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">排序值：</label>
					<div class="formControls col-xs-1">
						<input type="text" class="input-text" value="0" placeholder="" id="" name="cate_order">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">关键词：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="" placeholder="" id="" name="cate_keywords">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">分类摘要：</label>
					<div class="formControls col-xs-7">
						<textarea name="cate_description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符"></textarea>
						<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
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



