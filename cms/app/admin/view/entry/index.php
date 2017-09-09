
<extend file='resource/view/admin/admin.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="jumbotron">
            <h1>Hello, Everybody!</h1>
            <p>welcome to here! let's go to the category</p>
            <p><a class="btn btn-primary btn-lg" href="{{u('category.lists')}}" role="button">栏目管理</a>&nbsp;&nbsp;
                <a class="btn btn-primary btn-lg" href="{{u('article.lists')}}" role="button">文章管理</a>&nbsp;&nbsp;
                <a class="btn btn-primary btn-lg" href="{{u('config.setting')}}" role="button">网站配置</a>&nbsp;&nbsp;
                <a class="btn btn-primary btn-lg" href="{{u('flash.lists')}}" role="button">轮播图管理</a>
            </p>




        </div>
        <parent name="footer">
</block>














