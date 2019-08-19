<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemstocksms.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500400";

auth_check($auth[$sub_menu], "r");

/**
 * action url
 */
$action_url1 = G5_ADMIN_URL . '/?dir=shopetc&amp;pid=itemstocksmsupdate&amp;smode=1';

// 테이블 생성
if(!isset($g5['g5_shop_item_stocksms_table']))
    die('<meta charset="utf-8">dbconfig.php 파일에 <strong>$g5[\'g5_shop_item_stocksms_table\'] = G5_SHOP_TABLE_PREFIX.\'item_stocksms\';</strong> 를 추가해 주세요.');

if(!sql_query(" select ss_id from {$g5['g5_shop_item_stocksms_table']} limit 1", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['g5_shop_item_stocksms_table']}` (
                  `ss_id` int(11) NOT NULL AUTO_INCREMENT,
                  `it_id` varchar(20) NOT NULL DEFAULT '',
                  `ss_hp` varchar(255) NOT NULL DEFAULT '',
                  `ss_send` tinyint(4) NOT NULL DEFAULT '0',
                  `ss_send_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  `ss_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  `ss_ip` varchar(25) NOT NULL DEFAULT '',
                  PRIMARY KEY (`ss_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ", true);
}

$doc = strip_tags($doc);
$sort1 = strip_tags($sort1);
$sel_field = strip_tags($sel_field);
$search = get_search_string($search);

$sel_field = in_array($sel_field, array('it_id', 'ss_hp', 'ss_send')) ? $sel_field : 'it_id';
if ($sort1 == "") $sort1 = "ss_send";
if (!in_array($sort1, array('it_id', 'ss_hp', 'ss_send', 'ss_send_time', 'ss_datetime'))) $sort1 = "ss_send";
if ($sort2 == "" || $sort2 != "desc") $sort2 = "asc";

$sql_search = " where (1) ";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " and $sfl like '%$stx%' ";
    }
    if ($save_stx != $stx)
        $page = 1;
}

if ($fr_date && $to_date)
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql_search .= " and ss_datetime between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}

if (!$sst) {
    $sst  = "ss_send";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

$sql_common = "  from {$g5['g5_shop_item_stocksms_table']} ";

// 미전송 건수
$sql = " select count(*) as cnt " . $sql_common . " $sql_search and ss_send = '0' ";
$row = sql_fetch($sql);
$unsend_count = $row['cnt'];

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt $sql_common $sql_search ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select *
           $sql_common
           $sql_search
           $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    // 상품정보
    $sql = " select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['it_id']}' ";
    $it = sql_fetch($sql);

    if($it['it_name'])
        $it_name = get_text($it['it_name']);
    else
        $it_name = '상품정보 없음';

    $list[$i] = $row;
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', $it_name);
}

/**
 * 페이징
 */
$paging = $eb->set_paging('./?dir=shop&amp;pid=itemstocksms&amp;'.$qstr.'&amp;page=');

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';