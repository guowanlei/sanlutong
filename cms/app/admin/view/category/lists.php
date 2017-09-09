<extend file='resource/view/admin/admin.php'>
<block name="content">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{u('Category.lists')}}">栏目列表</a></li>
                    <li role="presentation"><a href="{{u('Category.post')}}">添加栏目</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td width="80">编号</td>
                        <td>栏目名称</td>
                        <td>栏目介绍</td>
                        <td>排序</td>
                        <td>父级栏目编号</td>

                        <td width="150">操作</td>
                    </tr>
                    <foreach from="$data" value="$v">
                        <tr>
                            <td>{{$v['cid']}}</td>
                            <td>{{$v['_catname']}}</td>
                            <td>{{$v['description']}}</td>
                            <td>{{$v['orderby']}}</td>
                            <td>{{$v['pid']}}</td>


                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                    <a href="{{u('post',['cid'=>$v['cid']])}}" class="btn btn-default">编辑</a>
                                    <a href="javascript:;" onclick="destory({{$v['cid']}})" type="button" class="btn btn-default">删除</a>
                                </div>
                            </td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>
        <script>
            function destory(cid) {
                if(confirm('确定删除吗?')){
                    location.href="{{u('delete')}}&cid=" + cid;
                }
            }
        </script>
    <script>
        require(['bootstrap']);
    </script>


        <parent name="footer">
<!--            {{$data->links();}}-->

</block>
