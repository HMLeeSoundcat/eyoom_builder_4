<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_search.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200810";

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['visit_table']} ";
if ($sfl) {
    if($sfl=='vi_ip' || $sfl=='vi_date'){
        $sql_search = " where $sfl like '$stx%' ";
    }else{
        $sql_search = " where $sfl like '%$stx%' ";
    }
}

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

$qstr .= "&amp;fr_date=".$fr_date."&amp;to_date=".$to_date;

if ($fr_date && $to_date) {
    $sql_search .= " and vi_date between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            order by vi_id desc
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $brow = $row['vi_browser'];
    if(!$brow)
        $brow = eb_get_brow($row['vi_agent']);

    $os = $row['vi_os'];
    if(!$os)
        $os = eb_get_os($row['vi_agent']);

    $device = $row['vi_device'];

    $link = "";
    $referer = "";
    $title = "";
    if ($row['vi_referer']) {

        $referer = get_text(cut_str($row['vi_referer'], 255, ""));
        $referer = urldecode($referer);

        if (!is_utf8($referer)) {
            $referer = iconv('euc-kr', 'utf-8', $referer);
        }

        $title = str_replace(array("<", ">"), array("&lt;", "&gt;"), $referer);
        $link = '<a href="'.get_text($row['vi_referer']).'" target="_blank" title="'.$title.'">';
    }

    if ($is_admin == 'super')
        $ip = $row['vi_ip'];
    else
        $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $row['vi_ip']);

    $list[$i] = $row;
    $list[$i]['brow'] = $brow;
    $list[$i]['os'] = $os;
    $list[$i]['device'] = $device;
    $list[$i]['referer'] = $referer;
    $list[$i]['title'] = $title;
    $list[$i]['link'] = $link;
    $list[$i]['ip'] = $ip;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('./?dir=member&amp;pid=visit_search&amp;'.$qstr.'&amp;domain='.$domain.'&amp;page=');

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';