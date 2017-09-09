<extend file='resource/view/admin/system.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{u('lists')}}">模块列表</a></li>
                    <li role="presentation"><a href="{{u('post')}}">设计模块</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td width="80">编号</td>
                        <td>模块标识</td>
                        <td>模块标题</td>
                        <td>模块作者</td>
                        <td>预览图片</td>
                        <td>系统模块</td>
                        <td>处理微信</td>
                        <td width="150">操作</td>
                    </tr>
                    <foreach from="$data" value="$v">
                        <tr>
                            <td>{{$v['id']}}</td>
                            <td>{{$v['name']}}</td>
                            <td>{{$v['title']}}</td>
                            <td>{{$v['author']}}</td>
                            <td>
                                <img src="{{$v['preview']}}" style="height: 60px;">
                            </td>
                            <td>

                                <if  value=" $v['is_system']=='是'" >
                                   是
                                <else/>
                                    否
                                </if>

                               </td>
                            <td>

                                <if   value="$v['is_weixin']=='是'">

                                    {{$v['is_weixin']}}
                                  <else/>
                                    否

                                </if>

                               </td>
                            <td>
                                <div class="btn-group btn-group-sm">

                                    <if   value="$v['isinstall']==1">
                                        <a href="javascript:;" onclick="destory('{{$v["name"]}}')" " type="button" class="btn btn-default">卸载</a>
                                        <else/>

                                        <a href="{{u('system.module.install',['name'=>$v['name']])}}"  " type="button" class="btn btn-default">安装</a>

                                    </if>

                                </div>
                            </td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>
        
        <script >
            function destory(name) {
                if(confirm('确定删除吗?')){
                    location.href="{{u('delete')}}&name=" + name;
                }
            }
        </script>
        <script>
            require(['bootstrap']);
        </script>


<!--        {{$data->links();}}-->
        <parent name="footer">
</block>