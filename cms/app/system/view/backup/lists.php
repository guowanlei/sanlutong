<extend file='resource/view/admin/system.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="javascript:;">备份列表</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td>备份目录</td>
                        <td>大小</td>
                        <td>备份时间</td>
                        <td width="150">操作</td>
                    </tr>
                    <foreach from="$dirs" value="$v">
                        <tr>
                            <td>{{$v['path']}}</td>
                            <td>{{Tool::getSize($v['size']);}}</td>
                            <td>{{date('Y-m-d H:h',$v['filemtime'])}}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="javascript:;" onclick="recovery({{$v['filename']}})" type="button" class="btn btn-default">还原</a>
                                    <a href="javascript:;" onclick="destory({{$v['filename']}})" type="button" class="btn btn-default">删除</a>
                                </div>
                            </td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>
        
        <script >
            function destory(name) {
                if(confirm('一旦删除，无法恢复！确定删除备份文件么吗?')){
                    location.href="{{u('delete')}}&name=" + name;
                }
            }
            function recovery(name) {
                if(confirm('确定要还原该备份目录么？')){
                    location.href="{{u('recovery')}}&name=" + name;
                }
            }
        </script>

        <parent name="footer">
</block>