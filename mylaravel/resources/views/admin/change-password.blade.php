@extends('layout.adminindex')
@section('content')

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="{{url('admin/index')}}" class="maincolor">首页</a> <span class="c-999 en">&gt;</span>
			<span class="c-666">admin</span><span class="c-999 en">&gt;</span>
			<span class="c-666">修改密码</span></nav>
	<article class="page-container">
		<form action="" method="post" class="form form-horizontal" id="form-change-password">
			{{csrf_field()}}

			<div style="width: 550px; margin: auto"  ><p><h3>修改密码</h3></p>
				@if(count($errors)>0)
					@if(is_object($errors))
						@foreach($errors->all() as $error)
							<span class="c-red">{{$error}}</span>
						@endforeach
					@else
						<span class="c-red">{{$errors}}</span>
					@endif
				@endif
				<fieldset>
			<div class="row cl">

			</div>
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>旧密码：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<input type="password" class="input-text" autocomplete="off" placeholder="请输入原密码" name="oldpassword" id="newpassword">
						</div>
					</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" placeholder="请输入新密码" name="newpassword" id="newpassword">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" placeholder="请输入确认密码" name="newpassword_confirmation" id="new-password2">
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
				</div>
			</div>
			</fieldset>
			</div>
		</form>
	</article>


	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/resources/views/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/resources/views/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/resources/views/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>

	<!--/请在上方写此页面业务相关的脚本-->
@endsection


