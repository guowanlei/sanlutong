<extend file='resource/view/admin/admin.php'>
    <block name="content">
        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="{{u('article.lists')}}">文章列表</a></li>
            <li><a href="{{u('article.post')}}">添加文章</a></li>
        </ul>
        <!-- TAB CONTENT -->
        <div class="tab-content">
            <div class="active tab-pane fade in" id="tab1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th  width="120">标题</th>
                        <th width="100">阅读量</th>
                        <th width="150">简介 介绍</th>
                        <th width="240">正文内容</th>
                        <th width="180">文章来源</th>
                        <th width="130">文章关键字</th>
                        <th width="100">文章作者</th>
                        <th width="80">文章排序</th>
                        <th width="80">是否推荐</th>
                        <th width="80">是否热门</th>
                        <th width="80">所属栏目</th>
                        <th width="60">缩略图</th>

                    </tr>
                    </thead>
                    <tbody>

                    <foreach  from="$data" value="$v">

                        <tr>
                            <td>{{$v['aid']}}</td>
                            <td  style="overflow: hidden;
                                        white-space:nowrap ;
                                        text-overflow: ellipsis;"  >{{$v['title']}}</td>
                            <td>{{$v['click']}}</td>
                            <td  style="overflow: hidden;
                                        white-space:nowrap ;
                                        text-overflow: ellipsis;">{{$v['description']}}</td>
                            <td  style="overflow: hidden;
                                        white-space:nowrap ;
                                        text-overflow: ellipsis;
                                        " >{{$v['content']}}</td>

                              <td  style="overflow: hidden;
                                        white-space:nowrap ;
                                        text-overflow: ellipsis;"> {{$v['source']}}</td>
                            <td   style="overflow: hidden;
                                        white-space:nowrap ;
                                        text-overflow: ellipsis;"> {{$v['keywords']}}</td>
                            <td> {{$v['author']}}</td>
                            <td> {{$v['orderby']}}</td>
                            <td> {{$v['iscommend']}}</td>
                            <td> {{$v['ishot']}}</td>
                            <td> {{$v['catname']}}</td>
                            <td><img src=" {{pic($v['thumb'])}}" alt=""  style="width: 40px;height: 40px;" >     </td>
                            <td>

                                <a href="{{u('post',['aid'=>$v['aid']])}}" class="btn btn-primary btn-xs">编辑</a>
                                <a href="javascript:;" onclick="destory({{$v['aid']}})" class="btn btn-danger btn-xs">删除</a>
                            </td>
                        </tr>

                    </foreach>

                    </tbody>
                </table>
            </div>


        </div>
        <script>
            function destory(aid) {
                if(confirm('确定删除吗?')){
                    location.href="{{u('delete')}}&aid=" + aid;
                }
            }
        </script>
        {{$data->links();}}
    </block>

