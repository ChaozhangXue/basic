<?phpYii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.mousewheel-3.0.4.pack.js');Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.pack.js');Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/js/fancybox/jquery.fancybox-1.3.4.css');Yii::app()->clientScript->registerScriptFile(F::baseUrl() . '/js/magnifier.js');?><script type="text/javascript">    $(document).ready(function () {        /* This is basic - uses default settings */        $("a#single_image").fancybox();        /* Using custom settings */        $("a#inline").fancybox({            'hideOnContentClick': true        });        /* Apply fancybox to multiple items */        $("a.group").fancybox({            'transitionIn': 'elastic',            'transitionOut': 'elastic',            'speedIn': 600,            'speedOut': 200,            'overlayShow': false        });        $("#LinkOrder").click(function (event) {            $('#orderForm').submit();        });        /*         * 暴力清除商品浏览历史记录！         */        $("#clearRec").click(function (event) {            $.ajax({                url: "<?php echo Yii::app()->createUrl('/item/clearHistory') ?>",                async: false            }),                $(".recent").html("").append("<div style='padding:20px'>没有商品浏览记录!</div>");        });        /*         * 加入进货单         */        $("#LinkPurchase").click(function (event) {            $.ajax({                type: "POST",                url: "<?php echo Yii::app()->createUrl('/cart/addCart') ?>",                data: "item_id=" + <?php echo $model->item_id ?> +"&qty=" +<?php echo $model->min_number ?>,                success: function () {                    alert("成功加入采购单");                }            })        });    });</script><style type="text/css">    .product-view-box {        position: absolute;        z-index: 2    }    .zoom {        width: 350px;        height: 350px;        border: 1px solid rgb(221, 221, 221);        margin-bottom: 5px;    }    .small-box {        position: relative;        width: 310px;        height: 54px;        padding: 0px 21px;    }    .small-box .btn-before, .small-box .btn-next {        position: absolute;        background: none repeat scroll 0% 0% white;        top: 0px;        width: 15px;        height: 52px;        display: block;        color: rgb(51, 51, 51);        border: 1px solid rgb(205, 205, 205);    }    .small-box .small-box-btn-off {        background: none repeat scroll 0% 0% rgb(252, 252, 250);        border-color: rgb(205, 205, 205);    }    .small-box .small-box-btn-off .btn-zoom {        color: rgb(205, 205, 205);    }    .small-box .btn-next {        right: 0px;    }    .small-box .btn-before {        left: 0px;    }    .small-box .btn-next .btn-zoom {        text-indent: -6px;    }    .small-box .btn-zoom {        font-size: 12px;        color: rgb(102, 102, 102);        position: absolute;        top: 18px;        left: 5px;        width: 6px;        height: 16px;        overflow: hidden;    }    .small-box .small-list {        position: absolute;        top: 0px;        left: 21px;    }    .small-box .small-list li {        float: left;        width: 62px;        text-align: center;        font-size: 0px;        position: relative;    }    .small-box .small-list img {        vertical-align: middle;        width: 50px;        height: 50px;        padding: 1px;        border: 1px solid rgb(206, 207, 206);    }    .small-box .small-list img .img-hover {        border: 2px solid rgb(228, 57, 60);        padding: 0px;    }    .zoom .zoom-mouse {        position: absolute;        left: 0px;        top: 0px;        background: #FFFFFF;        filter: alpha(opacity:50);        opacity: 0.5;        border: 1px solid #ccc;        display: none;    }    .zoom-div {        position: absolute;        left: 353px;        top: 0px;        border: 1px solid rgb(221, 221, 221);        overflow: hidden;        display: none;        z-index: 2;    }    .zoom-div img {        position: absolute;        left: 0px;        top: 0px;    }    .small-box .small-list img.img-hover {        border: 2px solid rgb(228, 57, 60);        padding: 0px;    }</style><?php$this->pageTitle = $model->title . ' - ' . Yii::app()->name . ' - 查看商品';$this->breadcrumbs = array(    '商品列表' => array('/item-list-all'),    $model->category->name => array('/item/index', 'category_id' => $model->category->id),    $model->title,);?><div class="item-detail">    <div class="item-detail-summary clearfix">        <div class="grid_9 alpha">            <div id="product-view-box">                <!--放大镜源-->                <div class="zoom">                    <!--源显示区域-->                    <img class="zoom-img" height="350px" width="350px" alt=""                         src="<?php echo $model->getMainPicUrl() ?>"/>                    <!--放大镜-->                    <div class="zoom-mouse" style=" height:175px; width:175px; "></div>                </div>                <!--放大镜效果区域-->                <div class="zoom-div" style="height:400px; width:400px;">                    <img src="<?php echo $model->getMainPicUrl() ?>"/>                </div>                <!--多图列表区域-->                <div class="small-box">                    <a class="btn-before small-box-btn-off" hidefocus="true" href="#" onclick="return false;"><b                            class="btn-zoom">◆</b></a>                    <div class="small-list" style=" width:310px;height:54px; overflow:hidden">                        <ul class="" style="position:absolute; left:0px; top:0px; width:372px;">                            <li><img class="img-hover" data-img="1" class=""                                     alt="京东CVT/希维途 男女款 防晒防紫外线两节 速干裤 快干裤 4款可选 32145男深灰色 XXL"                                     src="http://img13.360buyimg.com/n5/g10/M00/12/13/rBEQWFFiXNYIAAAAAAIMAWXjBMMAADorQNmdXUAAgwZ604.jpg"                                     height="50" width="50"></li>                            <li><img class="" data-img="1" alt="京东CVT/希维途 男女款 防晒防紫外线两节 速干裤 快干裤 4款可选 32145男深灰色 XXL"                                     src="http://img13.360buyimg.com/n5/g10/M00/05/1C/rBEQWFEuxnQIAAAAAAPQIKv9XZ4AABJ0AHyuLEAA9A4201.jpg"                                     height="50" width="50"></li>                            <li><img class="" data-img="1" alt="京东CVT/希维途 男女款 防晒防紫外线两节 速干裤 快干裤 4款可选 32145男深灰色 XXL"                                     src="http://img13.360buyimg.com/n5/g10/M00/05/1C/rBEQWVEuxnEIAAAAAASuSfhEincAABJ0AJZZtAABK5h458.jpg"                                     height="50" width="50"></li>                            <li><img class="" data-img="1" alt="京东CVT/希维途 男女款 防晒防紫外线两节 速干裤 快干裤 4款可选 32145男深灰色 XXL"                                     src="http://img13.360buyimg.com/n5/g10/M00/05/1C/rBEQWVEuxmkIAAAAAAXEYSovQHkAABJ0AG6c7oABcR5563.jpg"                                     height="50" width="50"></li>                            <li><img class="" data-img="1" alt="京东CVT/希维途 男女款 防晒防紫外线两节 速干裤 快干裤 4款可选 32145男深灰色 XXL"                                     src="http://img13.360buyimg.com/n5/g10/M00/05/1C/rBEQWFEuxnQIAAAAAAPQIKv9XZ4AABJ0AHyuLEAA9A4201.jpg"                                     height="50" width="50"></li>                            <li><img class="img-hover" data-img="1"                                     alt="京东CVT/希维途 男女款 防晒防紫外线两节 速干裤 快干裤 4款可选 32145男深灰色 XXL"                                     src="http://img13.360buyimg.com/n5/g10/M00/05/1C/rBEQWFEuxnQIAAAAAAPQIKv9XZ4AABJ0AHyuLEAA9A4201.jpg"                                     height="50" width="50"></li>                        </ul>                    </div>                    <a class="btn-next" hidefocus="true" href="#" onclick="return false;"><b class="btn-zoom">◆</b></a>                </div>            </div>            <script type="text/javascript"> magnifier();</script>            <!-- JiaThis Button BEGIN -->            <div id="jiathis_style_32x32" style="margin-top:10px;">                <a class="jiathis_button_qzone"></a>                <a class="jiathis_button_tsina"></a>                <a class="jiathis_button_tqq"></a>                <a class="jiathis_button_renren"></a>                <a class="jiathis_button_kaixin001"></a>                <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis"                   target="_blank"></a>                <a class="jiathis_counter_style"></a>            </div>            <script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>            <!-- JiaThis Button END -->        </div>        <div class="grid_16 omega">            <?php echo CHtml::beginForm(array('/cart/addToCart'), 'POST', array('id' => 'orderForm')) ?>            <div class="item-detail-title">                <h3><?php echo $model->title ?></h3>            </div>            <div class="item-detail-meta">                <?php echo CHtml::hiddenField('id', $model->item_id) ?>                <?php echo CHtml::hiddenField('pic_url', $model->getMainPic()) ?>                <?php echo CHtml::hiddenField('sn', $model->sn) ?>                <?php echo CHtml::hiddenField('title', $model->title) ?>                <?php echo CHtml::hiddenField('name', $model->item_id) ?>                <?php echo CHtml::hiddenField('price', $model->shop_price) ?>                <ul>                    <li class="price1">建议零售价：<?php echo $model->market_price ?>元</li>                    <li class="price2">批发价：<em><?php echo $model->currency . $model->shop_price ?></em>元</li>                    <li class="sn">商品编号：<?php echo $model->sn ?></li>                    <li class="unit">计量单位：<?php echo $model->unit ?></li>                    <li class="min_number">最少订货量：<?php echo $model->min_number ?> <?php echo $model->unit ?></li>                    <li class="stock">库存：<?php echo $model->stock ?> <?php echo $model->unit ?></li>                    <li class="click_count">浏览次数：<?php echo $model->click_count ?>次</li>                </ul>            </div>            <style type="text/css">                .sku ul, .props li {                    list-style: none;                    padding: 0;                    margin: 0;                    box-sizing: border-box;                }                .sku {                    width: 630px;                    border: 1px solid #ccc;                    box-sizing: border-box;                }                .sku {                    padding: 10px 0 10px;                }                .sku dt {                    clear: both;                }                .sku dd {                    font-size: 12px;                    padding: 5px 0;                }                .sku li {                    display: inline-block;                    padding: 5px 10px;                    border: solid 1px #000000;                }                .sku:last-child {                    border: 0;                }                .sku a:hover {                    cursor: pointer;                }                dl,dt,dd{                    margin:0;                    padding:0;                    display:inline-block;                }                dl{                    clear:both;                    display:block;                }                .sku .select {                    border: solid 1px red;                }            </style>            <div class="sku">                <?php foreach ($sku_data['checkbox'] as $prop_name => $sku) { ?>                    <dl>                        <dt><?php echo $prop_name; ?>: </dt>                        <dd>                            <ul>                                <?php foreach ($sku as $value => $name) { ?>                                <li class data-value="<?php echo $value; ?>"><a><?php echo $name; ?></a></li>                                <?php } ?>                            </ul>                        </dd>                    </dl>                <?php } ?>                <dl>                <dt></dt>                <dd>                    我要订购: <?php echo CHtml::textField('qty', $model->min_number, array('size' => '4', 'maxlength' => '5')) ?> <?php echo $model->unit ?>                    <em>(库存<span id="SpanStock" class="tb-count">99</span>件)</em>                </dd>                </dl>                <div class="d-action clearfix">                    <dl class="clearfix">                        <dd class="d-btn-buy">                            <a data-type="order" title="点击此按钮，到下一步确认购买信息。" target="_self" href="#" id="LinkOrder"                               class="dmtrack" rel="nofollow">立即购买</a>                        </dd>                        <dd class="d-btn-add">                            <a data-type="purchase" class="dmtrack" id="LinkPurchase" href="#" target="_self"                               title="加入进货单"                               rel="nofollow">加入进货单</a>                        </dd>                    </dl>                </div>            </div>            <script type="text/javascript">                var sku_data = <?php echo CJavaScript::encode($sku_data['table']); ?>;                $('.sku li').click(function() {                    if ($(this).attr('class').indexOf('select') == -1) {                        $(this).parent().children().removeClass('select');                        $(this).addClass('select');                    } else {                        $(this).removeClass('select');                    }                    var select_props = $('.sku .select');                    if (sku_data.length > 0 && select_props.length == sku_data[0].props.length) {                        for (var i in sku_data) {                            var props = sku_data[i].props;                            var isEquel = true;                            for (var j = 0; j < select_props.length; j++) {                                if ($(select_props[j]).data('value') != props[j])                                    isEquel = false;                            }                            if (isEquel) {                                $('.price2 em').text('￥'+sku_data[i].price);                                $('#SpanStock').text(sku_data[i].quantity);                            }                        }                    }                });            </script>            <?php echo CHtml::endForm(); ?>            <div class="box">                <div class="box-title">同类推荐</div>                <div class="box-content tuijian">                    <?php                    $cri = new CDbCriteria(array(                        'condition' => 'item_id != ' . $model->item_id . ' and category_id =' . $model->category_id,                        'limit' => '3'                    ));                    $items = Item::model()->findAll($cri);                    if ($items) {                        echo '<ul>';                        foreach ($items as $i) {                            ?>                            <li>                                <div class="image"><?php echo $i->getMainPic() ?></div>                                <div class="title"><?php echo $i->getTitle() ?></div>                                <div class="clear"></div>                                <div class="price">零售价：<span                                        class="currency"><?php echo $i->currency ?></span><em><?php echo $i->market_price ?></em>                                </div>                                <div class="price">批发价：<span                                        class="currency"><?php echo $i->currency ?></span><em><?php echo $i->shop_price ?></em>                                </div>                            </li>                        <?php                        }                        echo '</ul>';                    } else {                        ?>                        <p style="text-align:center">没有找到同类其他商品!</p>                    <?php } ?>                </div>            </div>        </div>    </div>    <div class="clear"></div>    <div>        <?php $this->widget('widgets.default.WItemProp', array('item' => $model)); ?>    </div>    <div style="margin-top:20px">        <div class="grid_19 alpha" style="overflow:hidden">            <?php            $this->widget('zii.widgets.jui.CJuiTabs', array(                'tabs' => array(                    '商品详情' => $this->renderPartial("_desc", array("model" => $model), true),//                '支付方式' => array('content' => 'Content for tab 2', 'id' => 'tab2'),                    '支付方式' => $this->renderPartial("_payment", array("model" => $model), true),                    // panel 3 contains the content rendered by a partial view                    '配送方式' => $this->renderPartial("_shipping", array("model" => $model), true),                    '常见问题' => $this->renderPartial("_faq", array("model" => $model), true),                ),                // additional javascript options for the tabs plugin                'options' => array(                    'collapsible' => true,                ),            ));            ?>        </div>        <div class="grid_6 omega">            <div class="box">                <div class="box-title">最近浏览过的商品                    <div class="extra"><a id="clearRec" href="javascript:void(0)">清空</a></div>                </div>                <div class="recent">                    <?php $this->widget('widgets.default.WItemHistory') ?>                </div>            </div>            <div class="box">                <div class="box-title">相关资讯</div>                <div class="box-content">                </div>            </div>        </div>    </div></div>