<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
    'About',
);
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>安装程序 - FFF内容管理系统</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#confirmNext").click(function () {
               if($('#readpact').attr('checked')){
                   $('#check-form').submit();
             }
              else alert("请选择确认此协议！");
            });
        });
            </script>
</head>

<body>

<div class="top">
    <div class="top-logo">
    </div>
    <div class="top-link">
        <ul>
            <li><a href="http://www.FANHAO.com" target="_blank">官方网站</a></li>
            <li><a href="http://bbs.FANHAO.com" target="_blank">技术论坛</a></li>
            <li><a href="http://help.FANHAO.com" target="_blank">帮助</a></li>
        </ul>
    </div>
    <div class="top-version">
        <!-- 版本信息 -->
        <h2>FFFANHAO</h2>
    </div>
</div>

<div class="main">
    <div class="pleft">
        <dl class="setpbox t1">
            <dt>安装步骤</dt>
            <dd>
                <ul>
                    <li class="now">许可协议</li>
                    <li>环境检测</li>
                    <li>参数配置</li>
                    <li>正在安装</li>
                    <li>安装完成</li>
                </ul>
            </dd>
        </dl>
    </div>
    <div class="pright">
        <div class="pr-title"><h3>阅读许可协议</h3></div>
        <div class="pr-agreement">
            <p>版权所有 (c)2003-2011，fanhao 保留所有权利。 </p>
            <p>感谢您选择fanhao内容管理系统（以下简称FH），FH是目前国内最强大、最稳定的中小型门户网站建设解决方案之一，基于 PHP + MySQL   的技术开发，全部源码开放。</p>
            <p>FANHAO 的官方网址是： <a href="http://www.FANHAO.com" target="_blank">www.FANHAO.com</a> 交流论坛：<a href="http://bbs.FANHAO.com" target="_blank"> bbs.FANHAO.com</a></p>
            <p>为了使你正确并合法的使用本软件，请你在使用前务必阅读清楚下面的协议条款：</p>
            <strong>一、本授权协议适用且仅适用于 FANHAO 5.x.x 版本，FANHAO官方对本授权协议的最终解释权。</strong>
            <strong>二、协议许可的权利 </strong>
            <p>1、您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途，而不必支付软件版权授权费用。 </p>
            <p>2、您可以在协议规定的约束和限制范围内修改 FANHAO 源代码或界面风格以适应您的网站要求。 </p>
            <p>3、您拥有使用本软件构建的网站全部内容所有权，并独立承担与这些内容的相关法律义务。 </p>
            <p>4、获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。 </p>
            <strong>二、协议规定的约束和限制 </strong>
            <p>1、未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目的或实现盈利的网站）。购买商业授权请登陆   <a href="http://bbs.FANHAO.com" target="_blank">bbs.FANHAO.com</a> 了解最新说明。</p>
            <p>2、未经官方许可，不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</p>
            <p>3、不管你的网站是否整体使用 FANHAO ，还是部份栏目使用 FANHAO，在你使用了 FANHAO 的网站主页上必须加上 FANHAO   官方网址(<a href="http://www.FANHAO.com" target="_blank">www.FANHAO.com</a>)的链接。</p>
            <p>4、未经官方许可，禁止在 FANHAO   的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。</p>
            <p>5、如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。 </p>
            <strong>三、有限担保和免责声明 </strong>
            <p>1、本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。 </p>
            <p>2、用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。 </p>
            <p>3、电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装   FANHAO，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</p>
            <p>4、如果本软件带有其它软件的整合API示范例子包，这些文件版权不属于本软件官方，并且这些文件是没经过授权发布的，请参考相关软件的使用许可合法的使用。</p>
            <p><b>协议发布时间：</b> 2008年1月18日</p>
            <p><b>版本最新更新：</b> 2011年2月21日 By FANHAO.com</p>
        </div>
        <form class="btn-box" id="check-form" method="post" action="<?php echo Yii::app()->createUrl('install/install/step1'); ?>">

            <input name="readpact" type="checkbox" id="readpact" value="" /><label for="readpact"><strong class="fc-690 fs-14">我已经阅读并同意此协议</strong></label>
           <?php echo CHtml::link("下一步", '#', array('id' => 'confirmNext', 'class' => 'btn btn-danger ')) ?>
        </form>
    </div>
</div>

<div class="foot">

</div>

</body>