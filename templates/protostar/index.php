<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');



?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Flora-Donna</title>
    <link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="templates/protostar/css/upf.css">
    <link rel="stylesheet" type="text/css" href="templates/protostar/css/style.css">
    <jdoc:include type="head" />
</head>
<body>
<section class="header">
    <div class="background">
        <div class='Node'>
            <div class="header_hoya Grid-Node-1-3">
                <div class="header_hoya_img className">
                    <a class="white_ring1" href='/hoi'>
                        <img src="/templates/protostar/img/img/hoya.png" alt="">
                    </a>
                </div>
					<span class="span_header className">
						<a href='/hoi'>Хои</a>
					</span>
            </div>
            <div class="header_shlumberger Grid-Node-1-3">
                <div class="header_hoya_img className2">
                    <a class="white_ring1" href='/decorative-deciduous'>
                        <img src="/templates/protostar/img/img/decor.png" class="header_shlumberger_img" alt="">
                    </a>
                </div>
					<span class="span_header">
						<a href='/decorative-deciduous'>Декоративно-лиственные</a>
					</span>
            </div>
            <div class="header_decoration Grid-Node-1-3">
                <div class="header_hoya_img className3">
                    <a class="white_ring1" href='/shlyumbergery'>
                        <img src="/templates/protostar/img/img/shl.png" class="header_decoration_img" alt="">
                    </a>
                </div>
					<span class="span_header">
						<a href='/shlyumbergery'>Шлюмбергеры</a>
					</span>
            </div>
        </div>
    </div>
    <div class="header_strip">

        <div class='Node'>
            <p class="gallery_order1 Grid-Node-1-3 Grid-No-Padding ">
                <a href='/gallery' name="orders">Галерея</a>
            </p>
            <div class="logo Grid-Node-1-3 Grid-No-Padding">
                <p class="name1  Grid-Node-1-3 Grid-No-Padding"><a href="/">Flora</a></p>
                <div class="div_logo_phone Grid-Node-1-3 Grid-No-Padding">
                    <div class="logo_phone">
                        <div class="logo_home className4">
                            <a class="white_ring2" href="/">
                                <img src="/templates/protostar/img/img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
              <p class="name2 Grid-Node-1-3 Grid-No-Padding">  <a href="/">Donna</a></p>
            </div>
            <p class="gallery_order2 Grid-Node-1-3 Grid-No-Padding "><a href="/order" name="gallery">Заказ</a></p>
        </div>
    </div>
    <hr>
    <div class="lent1 Grid-Node-1-2 Grid-No-Padding ">
        <img src="/templates/protostar/img/img/лента-слева.png" alt="">
    </div>
    <div class="lent2 Grid-Node-1-2 Grid-No-Padding ">
        <img src="/templates/protostar/img/img/лента-справа.png" alt="">
    </div>
</section>
<section class="Node">
    <jdoc:include type="component" />
</section>
<?php if ($this->countModules('new_khoi') || $this->countModules('new_shlumb') || $this->countModules('new_decor')){ ?>
<section class="Node">
    <div class='catalogs_header Node'>
        <div class="top Node"><hr><img src='templates/protostar/img/img/decorations1.png'></div>
        <p class="text_h1">Новинки</p>
        <div class="bottom Node"><hr><img src='templates/protostar/img/img/decorations2.png'></div>
    </div>
    <jdoc:include type="modules" name="new_khoi" style="none" />
    <jdoc:include type="modules" name="new_shlumb" style="none" />
    <jdoc:include type="modules" name="new_decor" style="none" />
</section>
<?php } ?>
<?php if ($this->countModules('sales_khoi') || $this->countModules('sales_shlumb') || $this->countModules('sales_decor')) { ?>
<section class="Node">
    <div class='catalogs_header Node'>
        <div class="top Node"><hr><img src='templates/protostar/img/img/decorations1.png'></div>
        <p class="text_h1">Скидки</p>
        <div class="bottom Node"><hr><img src='templates/protostar/img/img/decorations2.png'></div>
    </div>
    <jdoc:include type="modules" name="sales_khoi" style="none" />
    <jdoc:include type="modules" name="sales_shlumb" style="none" />
    <jdoc:include type="modules" name="sales_decor" style="none" />
</section>
<?php } ?>
<section class="footer">
    <div class="header_strip">
        <div class='Node'>
            <p class="gallery_order1 Grid-Node-1-3 Grid-No-Padding "><a href='/gallery'>Галерея</a></p>
            <div class="logo Grid-Node-1-3 Grid-No-Padding">
                <p class="mail"><a href="mailto:flora-donna@mail.ru">flora-donna@mail.ru</a></p>
            </div>
            <p class="gallery_order2 Grid-Node-1-3 Grid-No-Padding "><a href='/order'>Заказ</a></a></p>
        </div>
    </div>
    <div class="background_footer">
        <div class='footer_icons Node'>
            <div class="header_hoya_footer Grid-Node-1-3">
                <div class="header_hoya_img">
                    <a href="hoi" class="white_ring1">
                        <img src="/templates/protostar/img/img/hoya.png" alt="">
                    </a>
                </div>
					<span class="span_header">
						<a href='/hoi'>Хои</a>
					</span>
            </div>
            <div class="header_shlumberger_footer Grid-Node-1-3">
                <div class="header_hoya_img">
                    <a href="/decorative-deciduous" class="white_ring1">
                        <img src="/templates/protostar/img/img/decor.png" class="header_shlumberger_img" alt="">
                    </a>
                </div>
					<span class="span_header">
						<a href='/decorative-deciduous'>Декоративно-лиственные</a>
					</span>
            </div>
            <div class="header_decoration_footer Grid-Node-1-3">
                <div class="header_hoya_img">
                    <a href="/shlyumbergery" class="white_ring1">
                        <img src="/templates/protostar/img/img/shl.png" class="header_decoration_img" alt="">
                    </a>
                </div>
					<span class="span_header">
						<a href='/shlyumbergery'>Шлюмбергеры</a>
					</span>
            </div>
        </div>
    </div>
</section>

</body>
</html>