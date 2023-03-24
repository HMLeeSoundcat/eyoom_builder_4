<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/categoryform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-categoryform .alert {padding:5px 10px}
</style>

<div class="admin-shop-categoryform">
    <input type="hidden" name="ca_id" id="ca_id" value="<?php echo $ca_id; ?>">
    <input type="hidden" name="ca_stock_qty" id="ca_stock_qty" value="99999">
    <input type="hidden" name="ca_explan_html" id="ca_explan_html" value="1">
    <input type="hidden" name="ca_list_mod" id="ca_list_mod" value="3">
    <input type="hidden" name="ca_list_row" id="ca_list_row" value="5">
    <input type="hidden" name="ca_mobile_list_mod" id="ca_mobile_list_mod" value="10">
    <input type="hidden" name="ca_mobile_list_row" id="ca_mobile_list_row" value="0">

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 분류 등록/수정/삭제</strong><small class="font-size-12 color-grey margin-left-10">입력후 반드시 아래 적용하기 버튼을 누르세요.</small></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <?php if ($ca_id == '0' || !$ca_id) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">분류 위치</label>
                        </th>
                        <td colspan="3">
                            <div class="alert alert-info margin-bottom-0">
                                <p>분류 루트</p>
                            </div>
                        </td>
                    </tr>
                    <?php } else { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">분류 코드</label>
                        </th>
                        <td>
                            <label class="input state-disabled form-width-250px">
                                <input type="text" disabled value="<?php echo $cainfo['ca_id']; ?>" style="font-weight:bold">
                            </label>
                            <div class="note"><strong>Note:</strong> 분류코드는 고유코드로 수정하실 수 없습니다.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="ca_order" class="label">출력순서</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append fas fa-sort-numeric-down"></i>
                                <input type="text" name="ca_order" id="ca_order" value="<?php echo $cainfo['ca_order']; ?>">
                                <input type="hidden" name="ca_order_prev" id="ca_order_prev" value="<?php echo $cainfo['ca_order']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 작은 숫자가 먼저 출력됩니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ca_name" class="label">분류명<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="ca_name" id="ca_name" value="<?php echo $cainfo['ca_name']; ?>" required>
                                <input type="hidden" name="ca_name_prev" id="ca_name_prev" value="<?php echo $cainfo['ca_name']; ?>">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="ca_mb_id" class="label">관리회원 아이디</label>
                        </th>
                        <td>
                            <?php if ($is_admin == 'super') { ?>
                            <label class="input form-width-250px">
                                <input type="text" name="ca_mb_id" id="ca_mb_id" value="<?php echo $cainfo['ca_mb_id']; ?>">
                            </label>
                            <?php } else { ?>
                            <input type="hidden" name="ca_mb_id" value="<?php echo $ca['ca_mb_id']; ?>">
                            <?php echo $ca['ca_mb_id']; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">본인확인 체크</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="radio" for="ca_cert_use_yes"><input type="radio" name="ca_cert_use" id="ca_cert_use_yes" value="1" <?php echo $cainfo['ca_cert_use'] == '1' ? 'checked':'' ?>><i></i> 사용함</label>
                                <label class="radio" for="ca_cert_use_no"><input type="radio" name="ca_cert_use" id="ca_cert_use_no" value="0" <?php echo $cainfo['ca_cert_use'] == '0' ? 'checked':'' ?>><i></i> 사용안함</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">성인인증 체크</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="radio" for="ca_adult_use_yes"><input type="radio" name="ca_adult_use" id="ca_adult_use_yes" value="1" <?php echo $cainfo['ca_adult_use'] == '1' ? 'checked':'' ?>><i></i> 사용함</label>
                                <label class="radio" for="ca_adult_use_no"><input type="radio" name="ca_adult_use" id="ca_adult_use_no" value="0" <?php echo $cainfo['ca_adult_use'] == '0' ? 'checked':'' ?>><i></i> 사용안함</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ca_skin" class="label">출력스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="ca_skin" id="ca_skin">
                                <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $cainfo['ca_skin']); ?>
                                </select>
                                <i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="ca_mobile_skin" class="label">모바일 출력스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="ca_mobile_skin" id="ca_mobile_skin">
                                <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $cainfo['ca_mobile_skin']); ?>
                                </select>
                                <i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력이미지 사이즈</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="ca_img_width" class="input form-width-150px">
                                        <i class="icon-prepend">폭</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="ca_img_width" id="ca_img_width" value="<?php echo $cainfo['ca_img_width']; ?>">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="ca_img_height" class="input form-width-150px">
                                        <i class="icon-prepend">높이</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="ca_img_height" id="ca_img_height" value="<?php echo $cainfo['ca_img_height']; ?>">
                                    </label>
                                </span>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">모바일 출력이미지 사이즈</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="ca_mobile_img_width" class="input form-width-150px">
                                        <i class="icon-prepend">폭</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="ca_mobile_img_width" id="ca_mobile_img_width" value="<?php echo $cainfo['ca_img_width']; ?>">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="ca_mobile_img_height" class="input form-width-150px">
                                        <i class="icon-prepend">높이</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="ca_mobile_img_height" id="ca_mobile_img_height" value="<?php echo $cainfo['ca_img_height']; ?>">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">상품 출력수</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="ca_list_mod" class="input form-width-150px">
                                        <i class="icon-prepend">가로</i>
                                        <i class="icon-append">개</i>
                                        <input type="text" name="ca_list_mod" id="ca_list_mod" value="<?php echo $cainfo['ca_list_mod']; ?>">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="ca_list_row" class="input form-width-150px">
                                        <i class="icon-prepend">세로</i>
                                        <i class="icon-append">줄</i>
                                        <input type="text" name="ca_list_row" id="ca_list_row" value="<?php echo $cainfo['ca_list_row']; ?>">
                                    </label>
                                </span>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">모바일 상품 출력수</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="ca_mobile_list_mod" class="input form-width-150px">
                                        <i class="icon-prepend">가로</i>
                                        <i class="icon-append">개</i>
                                        <input type="text" name="ca_mobile_list_mod" id="ca_mobile_list_mod" value="<?php echo $cainfo['ca_mobile_list_mod']; ?>">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="ca_mobile_list_row" class="input form-width-150px">
                                        <i class="icon-prepend">세로</i>
                                        <i class="icon-append">줄</i>
                                        <input type="text" name="ca_mobile_list_row" id="ca_mobile_list_row" value="<?php echo $cainfo['ca_mobile_list_row']; ?>">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ca_stock_qty" class="label">기본 재고수량</label>
                        </th>
                        <td>
                            <label class="input form-width-150px">
                                <i class="icon-append">개</i>
                                <input type="text" name="ca_stock_qty" id="ca_stock_qty" value="<?php echo $cainfo['ca_stock_qty']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 상품의 기본재고 수량을 설정합니다.<br>재고를 사용하지 않는다면 숫자를 크게 입력하여 주십시오. 예) 999999 </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="ca_sell_email" class="label">판매자 E-mail</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="ca_sell_email" id="ca_sell_email" value="<?php echo $cainfo['ca_sell_email']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 운영자와 판매자가 다른 경우에 사용합니다. 이 분류에 속한 상품을 등록할 경우에 기본값으로 입력됩니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">판매가능</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="radio"><input type="radio" name="ca_use" id="ca_use1" value="1" <?php echo $cainfo['ca_use'] == '1' ? 'checked':'' ?>><i></i>판매진행</label>
                                <label class="radio"><input type="radio" name="ca_use" id="ca_use2" value="0" <?php echo $cainfo['ca_use'] == '0' ? 'checked':'' ?>><i></i>판매중지</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 재고가 없거나 일시적으로 판매를 중단하시려면 체크 해제하십시오.<br>체크 해제하시면 상품 출력을 하지 않으며, 주문도 받지 않습니다. </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">쿠폰적용안함</label>
                        </th>
                        <td>
                            <label class="checkbox" for="ca_nocoupon">
                                <input type="checkbox" name="ca_nocoupon" id="ca_nocoupon" value="1" <?php echo $cainfo['ca_nocoupon'] == '1' ? 'checked':'' ?>><i></i> 예
                            </label>
                            <div class="note"><strong>Note:</strong> 설정에 체크하시면 쿠폰생성 때 분류 검색 결과에 노출되지 않습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ca_include_head" class="label">상단 파일경로</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="ca_include_head" id="ca_include_head" value="<?php echo $cainfo['ca_include_head']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력하지 않으면 기본 상단 파일을 사용합니다. PHP 코드를 사용할 수 있습니다.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="ca_include_tail" class="label">하단 파일경로</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="ca_include_tail" id="ca_include_tail" value="<?php echo $cainfo['ca_include_tail']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력하지 않으면 기본 하단 파일을 사용합니다. PHP 코드를 사용할 수 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ca_include_head" class="label">분류삭제</label>
                        </th>
                        <td colspan="3">
                            <a href="javascript:;" onclick="delete_menu('<?php echo $cainfo['ca_id']; ?>','<?php echo $cainfo['ca_theme']; ?>');" class="btn-e btn-e-dark">삭제하기</a>
                            <span class="margin-left-10"><i class="fas fa-exclamation-circle color-red"></i> <span class="exp color-grey">주의! 삭제시, 서브분류까지 함께 삭제됩니다.</span></span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php if (!$ca_id == '0' || $ca_id) {?>
    <div class="text-center margin-bottom-30">
        <input type="submit" name="act_button" value="분류수정" class="btn-e btn-e-lg btn-e-red" accesskey="s" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    <?php if ($depth < 5) {?>
    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 서브 분류</strong><small class="font-size-12 color-grey margin-left-10">선택한 분류의 서브 분류를 생성합니다.</small></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="subca_name" class="label">서브 분류명<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="subca_name" id="subca_name" value="">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="subca_mb_id" class="label">관리회원 아이디</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="subca_mb_id" id="subca_mb_id" value="">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">본인확인 체크</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="radio" for="subca_cert_use_yes"><input type="radio" name="subca_cert_use" id="subca_cert_use_yes" value="1"><i></i> 사용함</label>
                                <label class="radio" for="subca_cert_use_no"><input type="radio" name="subca_cert_use" id="subca_cert_use_no" value="0" checked><i></i> 사용안함</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">성인인증 체크</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="radio" for="subca_adult_use_yes"><input type="radio" name="subca_adult_use" id="subca_adult_use_yes" value="1"><i></i> 사용함</label>
                                <label class="radio" for="subca_adult_use_no"><input type="radio" name="subca_adult_use" id="subca_adult_use_no" value="0" checked><i></i> 사용안함</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="subca_skin" class="label">출력스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="subca_skin" id="subca_skin">
                                <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, 'list.10.skin.php'); ?>
                                </select>
                                <i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="subca_mobile_skin" class="label">모바일 출력스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="subca_mobile_skin" id="subca_mobile_skin">
                                <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, 'list.10.skin.php'); ?>
                                </select>
                                <i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력이미지 사이즈</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="subca_img_width" class="input form-width-150px">
                                        <i class="icon-prepend">폭</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="subca_img_width" id="subca_img_width" value="600">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="subca_img_height" class="input form-width-150px">
                                        <i class="icon-prepend">높이</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="subca_img_height" id="subca_img_height" value="0">
                                    </label>
                                </span>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">모바일 출력이미지 사이즈</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="subca_mobile_img_width" class="input form-width-150px">
                                        <i class="icon-prepend">폭</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="subca_mobile_img_width" id="subca_mobile_img_width" value="600">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="subca_mobile_img_height" class="input form-width-150px">
                                        <i class="icon-prepend">높이</i>
                                        <i class="icon-append">px</i>
                                        <input type="text" name="subca_mobile_img_height" id="subca_mobile_img_height" value="0">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">상품 출력수</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="subca_list_mod" class="input form-width-150px">
                                        <i class="icon-prepend">가로</i>
                                        <i class="icon-append">개</i>
                                        <input type="text" name="subca_list_mod" id="subca_list_mod" value="3">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="subca_list_row" class="input form-width-150px">
                                        <i class="icon-prepend">세로</i>
                                        <i class="icon-append">줄</i>
                                        <input type="text" name="subca_list_row" id="subca_list_row" value="5">
                                    </label>
                                </span>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">모바일 상품 출력수</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="subca_mobile_list_mod" class="input form-width-150px">
                                        <i class="icon-prepend">가로</i>
                                        <i class="icon-append">개</i>
                                        <input type="text" name="subca_mobile_list_mod" id="subca_mobile_list_mod" value="3">
                                    </label>
                                </span>
                                <span> x </span>
                                <span>
                                    <label for="subca_mobile_list_row" class="input form-width-150px">
                                        <i class="icon-prepend">세로</i>
                                        <i class="icon-append">줄</i>
                                        <input type="text" name="subca_mobile_list_row" id="subca_mobile_list_row" value="5">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="subca_stock_qty" class="label">기본 재고수량</label>
                        </th>
                        <td>
                            <label class="input form-width-150px">
                                <i class="icon-append">개</i>
                                <input type="text" name="subca_stock_qty" id="subca_stock_qty" value="99999">
                            </label>
                            <div class="note"><strong>Note:</strong> 상품의 기본재고 수량을 설정합니다.<br>재고를 사용하지 않는다면 숫자를 크게 입력하여 주십시오. 예) 999999 </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="subca_sell_email" class="label">판매자 E-mail</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="subca_sell_email" id="subca_sell_email" value="">
                            </label>
                            <div class="note"><strong>Note:</strong> 운영자와 판매자가 다른 경우에 사용합니다. 이 분류에 속한 상품을 등록할 경우에 기본값으로 입력됩니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">판매가능</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label class="radio"><input type="radio" name="subca_use" id="subca_use1" value="1" checked><i></i>판매진행</label>
                                <label class="radio"><input type="radio" name="subca_use" id="subca_use2" value="0"><i></i>판매중지</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 재고가 없거나 일시적으로 판매를 중단하시려면 체크 해제하십시오.<br>체크 해제하시면 상품 출력을 하지 않으며, 주문도 받지 않습니다. </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">쿠폰적용안함</label>
                        </th>
                        <td>
                            <label class="checkbox" for="subca_nocoupon">
                                <input type="checkbox" name="subca_nocoupon" id="subca_nocoupon" value="1"><i></i> 예
                            </label>
                            <div class="note"><strong>Note:</strong> 설정에 체크하시면 쿠폰생성 때 분류 검색 결과에 노출되지 않습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="subca_include_head" class="label">상단 파일경로</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="subca_include_head" id="subca_include_head" value="">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력하지 않으면 기본 상단 파일을 사용합니다. PHP 코드를 사용할 수 있습니다.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="subca_include_tail" class="label">하단 파일경로</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="subca_include_tail" id="subca_include_tail" value="">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력하지 않으면 기본 하단 파일을 사용합니다. PHP 코드를 사용할 수 있습니다.</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="text-center">
        <input type="submit" name="act_button" value="분류생성" class="btn-e btn-e-lg btn-e-yellow" accesskey="s" onclick="document.pressed=this.value">
    </div>
    <?php } ?>
</div>

<script>
function fcategory_check(f) {
    var ca_name, ca_skin, ca_mobile_skin;
    var act_button = f.act_button.value;

    if (act_button == '분류수정') {
        ca_name = 'ca_name';
        ca_skin = 'ca_skin';
        ca_mobile_skin = 'ca_mobile_skin';
    } else if (act_button == '분류생성') {
        ca_name = 'subca_name';
        ca_skin = 'subca_skin';
        ca_mobile_skin = 'subca_mobile_skin';
    }

    if(f[ca_name].value == '') {
        alert('분류명은 필수항목입니다.');
        f[ca_name].focus();
        f[ca_name].select();
        return false;
    }

    if ($("#"+ca_skin+" option:selected").val() == '') {
        alert('출력스킨을 선택해 주세요.');
        $("#"+ca_skin).focus();
        return false;
    }

    if ($("#"+ca_mobile_skin+" option:selected").val() == '') {
        alert('모바일 출력스킨을 선택해 주세요.');
        $("#"+ca_mobile_skin).focus();
        return false;
    }

    var token = get_ajax_token();
    if(!token) {
        alert("토큰 정보가 올바르지 않습니다.");
        return false;
    }
    f.token.value = token;
    return true;
}

function delete_menu() {
    if(confirm("본 메뉴를 삭제하시면 하위메뉴까지 모두 삭제됩니다.\n\n그래도 삭제하시겠습니까?")) {
        var form = document.fcategory;
        var token = get_ajax_token();
        if(!token) {
            alert("토큰 정보가 올바르지 않습니다.");
            return false;
        }
        form.token.value = token;
        form.mode.value = 'delete';
        form.submit();
    } else return false;
}
</script>