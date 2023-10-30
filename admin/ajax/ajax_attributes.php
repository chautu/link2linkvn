<?php
	include "ajax_config.php";

	if(isset($_POST["listattr"]))
	{
		$listattr = (isset($_POST["listattr"])) ? json_decode($_POST["listattr"]) : [];
		$id = (isset($_POST["id"])) ? htmlspecialchars($_POST["id"]) : 0;
		
        $product = $d->rawQueryOne("select id_attr, attributes from #_product where id = ?", array($id));
        if(!empty($product)) {
            $detail_attrbutes = json_decode($product['attributes']);
        }

        $str = '';
        foreach($listattr as $id_attr) {
            $where = "";
            if($_POST['type'] == 2) { 
                $where .= "and type_hienthi = 1";   
            }
            $attr = $d->rawQueryOne("select * from #_product_attr where id = ? $where", array($id_attr));
            if(empty($attr)) {
                continue;
            }
            
            if (isset($detail_attrbutes->{'attr_'.$id_attr})) {
                $array_math = $detail_attrbutes->{'attr_'.$id_attr};
            } else {
                $array_math = [];
            }

            $str .= ' <div class="form-group col-xl-6 col-sm-4">
            <label class="d-block" for="attr_'.$id_attr.'">Danh mục '.$attr['ten'.$config['website']['lang-default']].':</label>';
            
            $row = $d->rawQuery("select * from #_product_attributes where id_attr = ? and hienthi > 0 order by stt, id desc", array($id_attr));

            $str .= '<select id="attr_'.$id_attr.'" name="data[attributes][attr_'.$id_attr.'][]" class="select multiselect form-control" multiple="multiple" required>';
            foreach($row as $attributes) {
                if(in_array($attributes['id'], $array_math)) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $str .= '<option value="'.$attributes["id"].'" '.$selected.'> '.$attributes['ten'.$config['website']['lang-default']].'</option>';
            }
            $str .= '</select>';
            $str .= '</div>';
        }
        echo $str;
	}
?>