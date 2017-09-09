<extend file='resource/view/admin/weixin.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation"><a href="?m=wx&action=controller/wx/index">管理文字回复</a></li>
                    <li role="presentation" class="active"><a href="?m=wx&action=controller/wx/post">添加关键字回复</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <form class="form-horizontal" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">文字回复</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keyword" class="col-sm-2 control-label">触发关键词</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="keyword" name="keyword" value="{{$keyword}}">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">文字回复</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">回复内容</label>
                    <div class="col-sm-8">
                        <textarea name="content" class="form-control" cols="30" rows="5">{{$wxcontent['content']}}</textarea>
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