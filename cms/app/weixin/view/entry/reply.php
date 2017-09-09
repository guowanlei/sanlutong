<extend file='resource/view/admin/weixin.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{u('reply')}}">系统回复</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <form class="form-horizontal" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">系统回复</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="default_message" class="col-sm-2 control-label">默认回复</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="default_message" name="default_message" value="{{$model['default_message']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="welcome" class="col-sm-2 control-label">关注回复</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="welcome" name="welcome" value="{{$model['welcome']}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>

        <parent name="footer">
</block>