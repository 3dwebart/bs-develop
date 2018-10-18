<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상품리스트에서 옵션항목
function get_list_options($it_id, $subject, $no)
{
    global $g5;

    if(!$it_id || !$subject)
        return '';

    $sql = " SELECT * FROM {$g5['g5_shop_item_option_table']} WHERE io_type = '0' AND it_id = '$it_id' AND io_use = '1' ORDER BY io_no ASC ";
    $result = sql_query($sql);
    if( !mysqli_num_rows($result) ) {
        return '';
    }

    $str = '';
    $subj = explode(',', $subject);
    $subj_count = count($subj);

    if($subj_count > 1) {
        $options = array();
        // 옵션항목 배열에 저장
        for($i=0; $opt_row=sql_fetch_array($result); $i++) {
            $opt_id = explode(chr(30), $opt_row['io_id']);

            for($k=0; $k<$subj_count; $k++) {
                if(!is_array($options[$k])) {
                    $options[$k] = array();
                }

                if($opt_id[$k] && !in_array($opt_id[$k], $options[$k])) {
                    $options[$k][] = $opt_id[$k];
                }
            }
        }

        // 옵션선택목록 만들기
        for($i=0; $i<$subj_count; $i++) {
            $opt = $options[$i];
            $opt_count = count($opt);
            $disabled = '';
            if($opt_count) {
                $seq = $no.'_'.($i + 1);
                if($i > 0)
                    $disabled = ' disabled="disabled"';
                $str .= '<tr>'.PHP_EOL;
                $str .= '<th><label for="it_option_'.$it_id.'_'.$seq.'">'.$subj[$i].'</label></th>'.PHP_EOL;

                $select = '<select id="it_option_'.$it_id.'_'.$seq.'" class="form-control it_option"'.$disabled.'>'.PHP_EOL;
                $select .= '<option value="">선택</option>'.PHP_EOL;
                for($k=0; $k<$opt_count; $k++) {
                    $opt_val = $opt[$k];
                    if(strlen($opt_val)) {
                        $select .= '<option value="'.$opt_val.'">'.$opt_val.'</option>'.PHP_EOL;
                    }
                }
                $select .= '</select>'.PHP_EOL;

                $str .= '<td>'.$select.'</td>'.PHP_EOL;
                $str .= '</tr>'.PHP_EOL;
            }
        }
    } else {
        $str .= '<tr>'.PHP_EOL;
        $str .= '<th><label for="it_option_'.$it_id.'_1">'.$subj[0].'</label></th>'.PHP_EOL;

        $select = '<select id="it_option_'.$it_id.'_1" class="form-control it_option">'.PHP_EOL;
        $select .= '<option value="">선택</option>'.PHP_EOL;
        for($i=0; $opt_row=sql_fetch_array($result); $i++) {
            if($opt_row['io_price'] >= 0)
                $price = '&nbsp;&nbsp;+ '.number_format($opt_row['io_price']).'원';
            else
                $price = '&nbsp;&nbsp; '.number_format($opt_row['io_price']).'원';

            if(!$opt_row['io_stock_qty'])
                $soldout = '&nbsp;&nbsp;[품절]';
            else
                $soldout = '';

            $select .= '<option value="'.$opt_row['io_id'].','.$opt_row['io_price'].','.$opt_row['io_stock_qty'].'">'.$opt_row['io_id'].$price.$soldout.'</option>'.PHP_EOL;
        }
        $select .= '</select>'.PHP_EOL;

        $str .= '<td>'.$select.'</td>'.PHP_EOL;
        $str .= '</tr>'.PHP_EOL;
    }

    return $str;
}
?>