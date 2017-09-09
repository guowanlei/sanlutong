<extend file='resource/view/admin/weixin.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{u('index')}}">连接设置</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <form class="form-horizontal" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">连接设置</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="weixinname" class="col-sm-2 control-label">公众号名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="weixinname" name="weixinname" value="{{c('wechat.weixinname')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="weixin" class="col-sm-2 control-label">微信号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="weixin" name="weixin" value="{{c('wechat.weixin')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="appid" class="col-sm-2 control-label">appid</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="appid" name="appid" value="{{c('wechat.appid')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="appsecret" class="col-sm-2 control-label">appsecret</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="appsecret" name="appsecret" value="{{c('wechat.appsecret')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="token" class="col-sm-2 control-label">token</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="token" name="token" value="{{c('wechat.token')}}" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label for="encodingaeskey" class="col-sm-2 control-label">encodingaeskey</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="encodingaeskey" name="encodingaeskey" value="{{c('wechat.encodingaeskey')}}" readonly="readonly">
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






