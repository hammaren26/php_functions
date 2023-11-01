<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<? if ($arResult['ITEMS']) { ?>
    <div class="data_slider owl-carousel js_owl_data">
        <? foreach ($arResult['ITEMS'] as $key => $resItem) { ?>
            <? if ($resItem['PROPERTIES']['YOUTUBE_LINK']) { ?>
                <div class="data_slider__slide data_slider_card data_slider_card--video">



                    <iframe
                            style="background-image: url(https://i.ytimg.com/vi/<?= GetYouTubeId('https://youtu.be/GxfnotRSvDQ') ?>/maxresdefault.jpg)"
                            width="455"
                            height="809"
                            data-src="https://www.youtube.com/embed/<?= GetYouTubeId('https://youtu.be/GxfnotRSvDQ') ?>?autoplay=1"
                    title="Инициация гранаты"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                    >



                    </iframe>


                    <button class="start">start</button>
                    <button class="stop">stop</button>
                </div>
            <? } else { ?>

                <div class="data_slider__slide data_slider_card">
                    <? if ($resItem['~PREVIEW_TEXT']) { ?>
                        <div class="data_slider_card__title"><?= $resItem['~PREVIEW_TEXT'] ?></div>
                    <? } ?>
                    <img class="data_slider_card__back_picture" src="<?= SITE_TEMPLATE_PATH ?>/img/back_phone.jpg" alt="">
                </div>
            <? } ?>
        <? } ?>
    </div>
<? } ?>

    <style>
        button {
            position: relative;
            z-index: 800;
        }
    </style>


    <script>
        $('.start').on('click', function () {
            let currentIframe = $(this).closest('.data_slider_card').find('iframe');
            currentIframe.attr('src', currentIframe.attr('data-src'))
        })
    </script>

<? /*

$GLOBALS['REVIEWS_ITEMS']['ONE'] = $arResult['ITEMS'];

if (file_exists($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/apiYoutube.php")) {
    require $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/apiYoutube.php";
}

*/?>