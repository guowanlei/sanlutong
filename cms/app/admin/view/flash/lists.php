<extend file='resource/view/admin/admin'>
    <block name="content">

        <!-- TAB NAVIGATION -->
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li class="active"><a href="{{u('lists')}}">轮播图列表</a></li>
                    <li><a href="{{u('post')}}">添加轮播图</a></li>
                </ul>
            </div>
        </div>
        <!-- TAB CONTENT -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="active tab-pane fade in" id="tab1">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="80">ID</th>
                                <th width="150">轮播图</th>
                                <th  width="200">文章标题</th>
                                <th width="120">描述介绍</th>
                                <th width="120">所属栏目</th>
                                <th width="80">排序值</th>
                                <th width="180">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <foreach from="$data" value="$v">
                                <tr>
                                    <td>{{$v['fid']}}</td>
                                    <td><img src="{{$v['thumb']}}" alt="" style="width: 100px;">
                                    </td>
                                    <td>{{$v['title']}}</td>

                                    <td>{{$v['description']}}</td>
                                    <td>{{$v['catname']}}</td>
                                    <td>{{$v['orderby']}}</td>
                                    <td>
                                        <a href="{{u('post',['fid'=>$v['fid']])}}" class="btn btn-primary btn-xs">编辑</a>
                                        <a href="javascript:;" onclick="destory({{$v['fid']}})" class="btn btn-danger btn-xs">删除</a>
                                    </td>
                                </tr>
                            </foreach>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{$data->links();}}
        <script>
            function destory(fid) {
                if (confirm('确认删除吗？')) {
                    location.href = "{{u('delete')}}&fid=" + fid;
                }
            }
        </script>
    </block>

