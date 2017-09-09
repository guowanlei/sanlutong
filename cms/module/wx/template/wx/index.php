<extend file="resource/view/admin/weixin.php"/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="?m=wx&action=controller/wx/index">管理文字回复</a></li>
                    <li role="presentation"><a href="?m=wx&action=controller/wx/post">添加关键字回复</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td width="80">编号</td>
                        <td>触发关键词</td>
                        <td>回复内容</td>
                        <td width="150">操作</td>
                    </tr>
                    <foreach from="$data" value="$v">
                        <tr>
                            <td>{{$v['id']}}</td>
                            <td>{{$v['keyword']}}</td>
                            <td>{{$v['content']}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                    <a href="{{url('wx.post',['id'=>$v['id']])}}"
                                       class="btn btn-default">编辑</a>
                                    <a href="javascript:;" onclick="destory({{$v['id']}})" type="button" class="btn btn-default">删除</a>
                                </div>
                            </td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>

        <script>
            function destory(id) {
                if (confirm('确定删除吗?')) {
                    location.href = "{{url('wx.delete')}}&id=" + id;
                }
            }
        </script>
        {{$data->links()}}
        <parent name="footer">
</block>