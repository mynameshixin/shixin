<?php
/**
 * User: gyd
 * Date: 15/9/9
 * Time: 下午8:10
 */
namespace App\Lib;

class Pagination
{

    public static function getLink($link, $params)
    {
        if(isset($params['page'])){
            unset ($params['page']);
        }
        return $link . "?" . join('&', $params) . "&page=";
    }

    public static function getPageSize($count, $page_size = 20)
    {
        if ($count == 0) {
            return 1;
        }
        if ($count % $page_size == 0) {
            return $count / $page_size;
        }
        return ceil($count / $page_size);
    }

    public static function render($page_size, $params, $link)
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        //添加参数link
        $link = self::getLink($link, $params); 

        $range = 10;
        $start_pos = floor(($page - 1) / $range) * $range + 1;
        $end_pos = $start_pos + $range - 1;
        if ($end_pos > $page_size)
            $end_pos = $page_size;

        $html = '<div class="pagination"><ul class="pagination">';
        $prev_page = $page - 1 <= 0 ? 1 : $page - 1;
        if($page > 1){
            $html .= "<li><a href=\"{$link}1\">首页</a></li>";
            $html .= "<li><a href=\"{$link}{$prev_page}\">上一页</a></li>";
        }

        foreach (range($start_pos, $end_pos) as $p) {
            if ($page == $p)
                $html .= "<li class=\"active\"><a href=\"{$link}{$p}\">{$p}</a></li>";
            else
                $html .= "<li><a href=\"{$link}{$p}\">{$p}</a></li>";
        }
        $next_page = $page + 1 > $page_size ? $page_size : $page + 1;
        if($page < $page_size){
            $html .= "<li><a href=\"{$link}{$next_page}\">下一页</a></li>";
            $html .= "<li><a href=\"{$link}{$page_size}\">尾页</a></li>";
        }
        $html .= '</ul></div>';

        return $html;
    }

}
