<extend file='resource/view/admin/admin.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <ul class="nav nav-pills">
            <li role="presentation"><a href="{{u('lists')}}">栏目列表</a></li>
            <li role="presentation" class="active"><a href="{{u('post')}}">添加栏目</a></li>
        </ul>
        <form class="form-horizontal" method="post" action="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">栏目数据</h3>
                </div>
            </div>
            <div class="form-group">
                <label for="catname" class="col-sm-2 control-label">栏目名称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="catname" name="catname"    value="{{$model['catname']}}"   placeholder="请输入栏目名称">
                </div>
            </div>
            <div class="form-group">
                <label for="catname" class="col-sm-2 control-label">父级栏目</label>
                <div class="col-sm-10">
                    <select name="pid" class="form-control">
                        <option value="0"> 顶级栏目</option>
                        <foreach from="$data" value="$v">
                            <if value="$model['pid'] == $v['cid']">
                                <option value="{{$v['cid']}}" selected="selected">{{$v['_catname']}}</option>
                                <else/>
                                <option value="{{$v['cid']}}" {{$v['_disabled']}}>{{$v['_catname']}}</option>
                            </if>


                        </foreach>

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">栏目描述</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" rows="10"   placeholder="请输入栏目描述">{{$model['description']}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="order" class="col-sm-2 control-label">栏目排序</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="order" name="orderby" value="{{$model['orderby']}}" placeholder="请输入栏目排序值">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button class="btn btn-primary">保存数据</button>
                </div>
            </div>
        </form>


        <parent name="footer">
</block>