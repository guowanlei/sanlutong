<extend file='resource/view/admin/system.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="{{url('user.index')}}">友情链接管理</a></li>
                    <li role="presentation" class="active"><a href="{{url('user.post')}}">添加友情链接</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <form class="form-horizontal" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">添加友情链接</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">链接名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title" value="{{$data['title']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-sm-2 control-label">链接地址</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="url" name="url" value="{{$data['url']}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">保存数据</button>
                    </div>
                </div>
            </form>
        </div>

        <parent name="footer">
</block>