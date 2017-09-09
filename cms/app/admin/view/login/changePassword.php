<extend file='resource/view/admin/admin.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="javascript:;">修改密码</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="?s=admin/login/changepassword">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">修改密码</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catname" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{v('userinfo.username')}}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">新密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="请输入新密码"    value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="请输入确认密码" id="password_confirm" name="password_confirm" value="">
                        </div>
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