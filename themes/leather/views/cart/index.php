<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/cart/core.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/cart/box.css');
$this->breadcrumbs = array(
    '购物车',
);
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#updateCart").click(function (event) {
            $('#cartForm').submit();
        });
    });

</script>

<div id="sssss">ssss</div>
<div class="box">
    <div class="box-title container_24">购物车</div>
    <div class="box-content cart container_24">
        <?php echo CHtml::beginForm(array('/order/checkout'), 'POST', array('id' => 'cartForm')) ?>
        <table width="100%" border="1" cellspacing="1" cellpadding="0" style="text-align:center;vertical-align:middle" id="cart-table">
            <tr>
                <th width="2%"><?php echo CHtml::checkBox('checkAllPosition', false, array('data-url' => Yii::app()->createUrl('cart/getPrice'))); ?></th>
                <th width="14%">图片</th>
                <th width="14%">名称</th>
                <th width="14%">属性</th>
                <th width="14%">价格</th>
                <th width="14%">数量</th>
                <th width="14%">小计</th>
                <th width="14%">操作</th>
            </tr>
            <?php
            $cart = Yii::app()->cart;
            $items = $cart->getPositions();
            if (empty($items)) {
                ?>
                <tr>
                    <td colspan="8" style="padding:10px">您的购物车是空的!</td>
                </tr>
            <?php
            } else {
                foreach ($items as $key => $item) {
                    ?>
                    <tr><?php
                        $itemUrl = Yii::app()->createUrl('item/view', array('id' => $item->item_id));
                        ?>
                        <td style="display:none;">
                            <?php echo CHtml::hiddenField('item_id[]', $item->item_id, array('id' => '','class' => 'item-id'));
                                   echo CHtml::hiddenField('props[]', empty($item->sku) ? '' : implode(';', json_decode($item->sku->props, true)),  array('id' => '','class' => 'props'));?>
                        </td>
                        <td><?php echo CHtml::checkBox('position[]', false, array('value' => $key, 'data-url' => Yii::app()->createUrl('cart/getPrice'))); ?></td>
                        <td><a href="<?php echo $itemUrl; ?>"><?php echo CHtml::image($item->getMainPic(), $item->title, array('width' => '80px', 'height' => '80px')); ?></a></td>
                        <td><?php echo CHtml::link($item->title, $itemUrl); ?></td>
                        <td><?php echo empty($item->sku) ? '' : implode(';', json_decode($item->sku->props_name, true)); ?></td>
                        <td><?php echo $item->getPrice(); ?></td>
                        <td><?php echo CHtml::textField('quantity[]', $item->getQuantity(), array('size' => '4', 'maxlength' => '5', 'data-url' => Yii::app()->createUrl('cart/update'), 'data-num' => '3231')); ?></td>
                        <td><?php echo $item->getSumPrice() ?>元</td>
                        <td><?php echo CHtml::link('移除', array('/cart/remove', 'key' => $item->getId())) ?></td>
                    </tr>
                <?php
                }
            } ?>
            <tr>
                <td colspan="8" style="padding:10px;text-align:right">总计：<label id="total_price">0</label>元</td>
            </tr>
            <tr>
                <td colspan="8" style="vertical-align:middle"><span
                        style="float:left;padding:5px 10px;"><?php echo CHtml::link('清空购物车', array('/cart/clear'), array('class' => 'btn')) ?></span>
                    <span
                        style="float:right;padding:5px 10px;"><?php echo CHtml::link('继续购物', array('/'), array('class' => 'btn')) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span
                        style="float:right;padding:5px 10px;"><?php echo CHtml::link('更新购物车', array('/cart/index'), array('id' => 'updateCart', 'class' => 'btn')) ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="8"><span
                        style="float:right;padding:5px 10px;"><?php echo CHtml::submitButton('结算', array('class' => 'btn1')) ?></span>
                </td>
            </tr>
        </table>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>
<script type="text/javascript">
    $('#cart-table').on('keyup', 'input[type=text]', function(){
        var $this = $(this),
            $tr = $this.closest('tr'),
            props = $tr.find('.props'),
            tempId = $tr.find('.item-id'),
            qty = $.trim(this.value);
        clearTimeout(window.delay);
        window.delay = setTimeout(function(){
            $this.blur();
            // check input data
            if(!/^\d+$/.test(qty)){
                return;
            }
            var html = '<input type="hidden" name="hid" value="0">';
            // compare number
            if(parseInt(qty) <= parseInt($this.data('num'))){
                $.post($(this).data('url'), {'item_id': tempId, 'props': props, 'qty': qty}, function (response) {
//             window.location.reload();
//                    $("id").attr("value");
                }, 'json');
            }else{
                var s = "库存不足，请更改物品数量！";
                document.write(s);
//                show error
            }
        }, 500);
    });
//    $('[name="quantity[]"]').change(function () {
//        var item_id = $(this).parents('tr').find('[name="item_id[]"]').val();
//        var props = $(this).parents('tr').find('[name="props[]"]').val();
//        var qty = $(this).val();
//        var data = {'item_id': item_id, 'props': props, 'qty': qty};
//        $.post($(this).data('url'), data, function (response) {
//          window.location.reload();
//        }, 'json');
//    });
    function getprice() {
        var positions = [];
        $('[name="position[]"]:checked').each(function () {
            positions.push($(this).val());
        });
        $.get($(this).data('url'), {'positions': positions}, function (response) {
            if (!response.msg) {
                $('#total_price').text(response.total);
            }
        }, 'json');
    }
    $('#checkAllPosition').click(function () {
        if ($(this).attr('checked')) {
            $('[name="position[]"]').attr('checked', 'checked');
        } else {
            $('[name="position[]"]').removeAttr('checked');
        }
    });
    $('#cartForm').on('click', '[name="position[]"]', getprice);
</script>