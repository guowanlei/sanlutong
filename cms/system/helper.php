<?php
/** .-------------------------------------------------------------------
 * | 函数库
 * '-------------------------------------------------------------------*/

//自定义的函数库 已自动加载


//使用框架系统的跳转方法message 来跳转到拓展模块 需要自定义一个跳转函数
//http_build_query — 生成 URL-encode 之后的请求字符串
//说明 ¶
//string http_build_query ( mixed $query_data [, string $numeric_prefix [, string $arg_separator [, int $enc_type = PHP_QUERY_RFC1738 ]]] )
//
//使用给出的关联（或下标）数组生成一个经过 URL-encode 的请求字符串。
function url($path,array $param = []){
    $module = \houdunwang\request\Request::get('m');
    $path = str_replace('.','/',$path);
    $args = $param ? '&'.http_build_query($param) : '';
    $url = __ROOT__ . "?m={$module}&action=controller/{$path}" . $args;
    return $url;
}














