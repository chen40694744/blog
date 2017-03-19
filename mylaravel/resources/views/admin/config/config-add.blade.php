@extends('layout.adminindex')
@section('content')

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="{{url('admin/index')}}" class="maincolor">首页</a> <span class="c-999 en">&gt;</span>
			<span class="c-666">资讯管理</span><span class="c-999 en">&gt;</span>
			<span class="c-666">添加配置项</span></nav>
		<div class="Hui-article">
			<article class="cl pd-20">
		<form class="form form-horizontal" id="form-article-add" action="{{url('admin/config')}}" method="post">
			{{csrf_field()}}
			<div style="width: 60%; margin: auto"  >
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
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>配置项名称：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="" placeholder="" id="" name="conf_name">
					</div>
				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>配置项标题：</label>
					<div class="formControls col-xs-5">
						<input type="text" class="input-text" value="" placeholder="" id="" name="conf_title">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">类型：</label>
					<div class="formControls col-xs-2 ">
						<span style="font-size: 18px">input</span><input type="radio" id="" name="field_type" value="input" checked onclick="showTR()" style=" float:left;margin-top:0.8em;margin-right:0.3em; width: 15px; height: 15px;">
					</div>
					<div class="formControls col-xs-2">
						<span style="font-size: 18px">textarea</span><input type="radio" id="" name="field_type" value="textarea" onclick="showTR()" style=" float:left;margin-top:0.8em;margin-right:0.3em; width: 15px; height: 15px;">
					</div>
					<div class="formControls col-xs-2">
						<span style="font-size: 18px">radio</span><input type="radio" id="" name="field_type" value="radio" onclick="showTR()" style=" float:left;margin-top:0.8em;margin-right:0.3em; width: 15px; height: 15px;">
					</div>
				</div>

				<div class="row cl" id="field_value">
					<label class="form-label col-xs-4 col-sm-2">类型值：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" placeholder="类型只有带radio的情况下才需要配置，格式 1|开启，0|关闭" id="" name="field_value" width="30px">
					</div>

				</div>

				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">排序值：</label>
					<div class="formControls col-xs-2">
						<input type="text" class="input-text" value="0" placeholder="" id="" name="conf_order">
					</div>
				</div>


				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">说明：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea name="conf_tips" id="" cols="" rows="" class="textarea"></textarea>
					</div>
				</div>

				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
						<button class="btn btn-default radius" onclick="history.go(-1)" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
		</form>
	</article>
		</div>
	</section>
<script>
	showTR();
	function showTR() {
		var type=$('input[name=field_type]:checked').val();
		if(type=='radio'){
			$('#field_value').show();
		}else {
            $('#field_value').hide();
		}
    }
</script>
@endsection



