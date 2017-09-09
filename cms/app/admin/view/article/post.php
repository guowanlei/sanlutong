<extend file='resource/view/admin/admin.php'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{u('lists')}}">文章列表</a></li>
<!--        <li><a href="">回收站</a></li>-->
        <li class="active"><a href="{{u('post')}}">添加文章</a></li>
    </ul>
    <form action="" method="post">
        <div class="form-group">
            <label>所属栏目</label>
            <select name="categorycid" class="form-control" required>
                <option value="">请选择</option>
           <foreach   from="$data" key="$k"  value="$v">

               <if  value="$model['categorycid']==$v['cid']"  >
                   <option value="{{$v['cid']}}"  selected="selected" >{{$v['catname']}}</option>

                  <else/>
                   <option value="{{$v['cid']}}">{{$v['_catname']}}</option>

               </if>



                </foreach>
            </select>
        </div>
        <div class="form-group">
            <label>文章标题</label>
            <input type="text" class="form-control" name="title" value="{{$model['title']}}">
        </div>
        <div class="form-group">
            <label>作者</label>
            <input type="text" class="form-control" name="author" value="{{$model['author']}}">
        </div>
        <div class="form-group">
            <label>关键字</label>
            <textarea name="keywords" class="form-control" cols="30" rows="5">{{$model['keywords']}}</textarea>
        </div>
        <div class="form-group">
            <label>描述</label>
            <textarea name="description" class="form-control" cols="30" rows="5">{{$model['description']}}</textarea>

        </div>
        <div class="form-group">
            <label>文章正文</label>
            <textarea id="container" style="height:300px;width:100%;" name="content">{{$model['content']}}</textarea>
            <script>
                util.ueditor('container', {hash:2,data:'hd'}, function (editor) {
                    //这是回调函数 editor是百度编辑器实例
                });
            </script>
        </div>
        <!--        第二个参数为添加到数据表中字段，hash为确定上传文件标识（可以以用户编号，标识为此用户上传的文件，系统使用这个字段值来显示文件列表），data为数据表中的data字段值，开发者根据业务需要自行添加-->

        <div class="form-group">
            <label>来源</label>
            <input type="text" class="form-control" name="source" value="{{$model['source']}}">
        </div>

        <div class="form-group">
            <label>点击次数</label>
            <input type="text" class="form-control" name="click" value="{{$model['click']}}">
        </div>
        <div class="form-group">
            <label>排序</label>
            <input type="text" class="form-control" name="orderby" value="{{$model['orderby']}}">
        </div>
        <div class="form-group">
            <label>跳转地址</label>
            <input type="text" class="form-control" name="linkurl" value="{{$model['linkurl']}}">
        </div>
        <div class="form-group">
            <label class="checkbox-inline">
                <input type="checkbox" name="iscommend" value="是" <if value="$model['iscommend'] == '是'">checked="checked"</if>> 推荐
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" name="ishot" value="是" <if value="$model['ishot'] == '是'">checked="checked"</if>> 热门
            </label>
        </div>



            <div class="form-group">

                <label>缩略图</label>

                <input type="text" class="form-control" name="thumb" readonly="" value="{{$model['thumb']}}">
                <br>
                <div class="input-group-btn">
                    <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                </div>
            </div>
            <div class="input-group" style="margin-top:5px;">
                <img src="{{pic($model['thumb'])}}" class="img-responsive img-thumbnail" width="150">
                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="removeImg(this)">×</em>

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

        <br>
        <button   type="submit" class="btn btn-primary">保存</button>
    </form>
</block>

