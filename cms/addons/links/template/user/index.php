<extend file='resource/view/admin/system.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{url('user.index')}}">友情链接管理</a></li>
                    <li role="presentation"><a href="{{url('user.post')}}">添加友情链接</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td width="80">编号</td>
                        <td>链接名称</td>
                        <td>链接地址</td>
                        <td width="150">操作</td>
                    </tr>
                    <foreach from="$data" value="$v">
                        <tr>
                            <td>{{$v['id']}}</td>
                            <td>{{$v['title']}}</td>
                            <td>{{$v['url']}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">

                                    <a href="{{url('user.post',['id'=>$v['id']])}}"
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
                    location.href = "{{url('user.delete')}}&id=" + id;
                }
            }
        </script>
        <script>
            require(['bootstrap']);
        </script>
        {{$data->links()}}
        <parent name="footer">
</block>