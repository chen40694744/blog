@extends('layout.adminindex')
@section('content')

	<section class="Hui-article-box">
		<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="{{url('admin/index')}}" class="maincolor">首页</a> <span class="c-999 en">&gt;</span>
			<span class="c-666">文章管理</span><span class="c-999 en">&gt;</span>
			<span class="c-666">添加文章</span></nav>
		<div class="Hui-article">
			<article class="cl pd-20">
		<form class="form form-horizontal" id="form-article-add" action="{{url('admin/article')}}" method="post">
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
				<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
				<div class="formControls col-xs-5">
					<input type="text" class="input-text" value="" placeholder="" id="" name="art_title">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">文章分类：</label>
				<div class="formControls col-xs-2">
				<select title="" style="width: 150px; height: 35px;" name="cate_id" class="select" >
					@foreach($pid as $d)
					<option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
					@endforeach
				</select>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">编辑：</label>
				<div class="formControls col-xs-5">
					<input type="text" class="input-text" value="" placeholder="" id="" name="art_editor">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">缩略图：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<div class="uploader-thum-container">
						<div id="fileList" class="uploader-list"></div>
						<input title="" type="text" class="input-text" id="" name="art_thumb" style="width: 300px;">
						<input id="file_upload" name="file_upload" type="file" multiple="true">
					</div>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2"></label>
				<div class="formControls col-xs-8 col-sm-9">
					<img src="" alt="" id="art_thumb_img" width="200px" height="160px">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">关键词：</label>
				<div class="formControls col-xs-5">
					<input type="text" class="input-text" value="" placeholder="" id="" name="art_tag">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">分类摘要：</label>
				<div class="formControls col-xs-8">
					<textarea name="art_description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100"></textarea>
					<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
				<div class="formControls col-xs-8">
					<script id="editor" name="art_content" type="text/plain" style="width:100%;height:400px;"></script>
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
					<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont"></i>提交</button>
					<button class="btn btn-default radius" onclick="history.go(-1)" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
				</div>
			</div>
			</div>
		</form>
	</article>
		</div>
	</section>

	<!--请在下方写此页面业务相关的脚本-->

	<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
	<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
	<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
	<script type="text/javascript">
            $(function(){


                var ue = UE.getEditor('editor');
            });
	</script>
	<!--uploader-->
	<script src="/org/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="/org/uploadify/uploadify.css">
	<script type="text/javascript">
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload').uploadify({
                'buttonText' : '选择文件',
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    '_token'     : "{{csrf_token()}}"
                },

                'swf'      : "{{asset('/org/uploadify/uploadify.swf')}}",
                'uploader' : "{{url('admin/upload')}}",

                'onUploadSuccess' : function(file, data) {
                    $('input[name=art_thumb]').val(data);
                    $('#art_thumb_img').attr('src','/'+data);
                }
            });
        });
	</script>

	<style>
		.uploadify{display: inline-block;}
		.uploadify-button{border: none; border-radius:5px;margin-top: 8px; }
	</style>


	<!--/请在上方写此页面业务相关的脚本-->
@endsection



