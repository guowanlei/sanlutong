<extend file='resource/view/admin/system.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{url('user.index')}}">友情链接管理</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td width="80">编号</td>
                        <td>热门关键词</td>
                        <td>搜索次数</td>
                    </tr>
                    <foreach from="$data" value="$v">
                        <tr>
                            <td>{{$v['id']}}</td>
                            <td>{{$v['keyword']}}</td>
                            <td>{{$v['sousuo_num']}}</td>
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
<!--        {{$data->links()}}-->
        <parent name="footer">
</block>