<extend file='resource/view/admin/system.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="{{u('lists')}}">模块列表</a></li>
                    <li role="presentation" class="active"><a href="{{u('post')}}">设计模块</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">设计模块</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">模块标识</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">模块标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc" class="col-sm-2 control-label">模块描述</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="desc" class="form-control" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desc" class="col-sm-2 control-label">预览图片</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="preview" readonly="" value="">
                                    <div class="input-group-btn">
                                        <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                                    </div>
                                </div>
                                <div class="input-group" style="margin-top:5px;">
                                    <img src="{{__ROOT__}}/resource/images/thumb.jpg" class="img-responsive img-thumbnail" width="150">
                                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="removeImg(this)">×</em>
                                </div>
                            </div>
                            <script>
                                //上传图片
                                function upImage(obj) {
                                    require(['util'], function (util) {
                                        options = {
                                            multiple: false,//是否允许多图上传
                                            //data是向后台服务器提交的POST数据
                                            data:{name:'后盾人',year:2099},
                                        };
                                        util.image(function (images) {          //上传成功的图片，数组类型

                                            $("[name='preview']").val(images[0]);
                                            $(".img-thumbnail").attr('src', images[0]);
                                        }, options)
                                    });
                                }

                                //移除图片
                                function removeImg(obj) {
                                    $(obj).prev('img').attr('src', 'resource/images/nopic.jpg');
                                    $(obj).parent().prev().find('input').val('');
                                }
                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author" class="col-sm-2 control-label">模块作者</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label for="is_system" class="col-sm-2 control-label">系统模块</label>-->
<!--                        <label class="checkbox-inline">-->
<!--                                <input type="checkbox" name="is_system" id="is_system" value="是"> 是-->
<!--                        </label>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="is_weixin" class="col-sm-2 control-label">处理微信</label>
                        <label class="checkbox-inline">
                            <input type="checkbox" name="is_weixin" id="is_weixin" value="是"> 是

                        </label>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-primary">保存数据</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <parent name="footer">
</block>