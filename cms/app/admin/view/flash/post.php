<extend file='resource/view/admin/admin.php'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <div class="panel panel-default">
        <div class="panel-body">
            <ul class="nav nav-pills">
                <li><a href="{{u('lists')}}">轮播图列表</a></li>
                <li class="active"><a href="{{u('post')}}">添加轮播图</a></li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">轮播图图片</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="thumb" readonly="" value="{{$model['thumb']}}">
                        <div class="input-group-btn">
                            <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                        </div>
                    </div>
                    <div class="input-group" style="margin-top:5px;">
                        <img src="{{pic($model['thumb'])}}" class="img-responsive img-thumbnail" width="150">
                        <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                            onclick="removeImg(this)">×</em>
                    </div>
                    <script>
                        //上传图片
                        function upImage(obj) {
                            require(['util'], function (util) {
                                options = {
                                    multiple: false,//是否允许多图上传
                                    //data是向后台服务器提交的POST数据
                                    data: {name: '后盾人', year: 2099},
                                };
                                util.image(function (images) {          //上传成功的图片，数组类型

                                    $("[name='thumb']").val(images[0]);
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
                <div class="form-group">
                    <label>跳转文章</label>
                    <select name="article_aid" class="form-control" required>
                        <option value="0">请选择</option>
                        <foreach from="$article" value="$v">
                            <if value="$model['article_aid'] == $v['aid']">
                                <option value="{{$v['aid']}}" selected="selected">{{$v['title']}}</option>
                                <else/>
                                <option value="{{$v['aid']}}">{{$v['title']}}</option>
                            </if>

                            </if>

                        </foreach>
                    </select>
                </div>
                <div class="form-group">
                    <label>描述</label>
                    <textarea name="description" class="form-control" cols="30"
                              rows="5">{{$model['description']}}</textarea>

                </div>
                <div class="form-group">
                    <label>排序</label>
                    <input type="text" class="form-control" name="orderby" value="{{$model['orderby']}}">
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
</block>

