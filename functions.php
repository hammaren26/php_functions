<?php


/*
 * Возвращает код видео из ссылки на youtube
 * $url - УРЛ видео youtube
 * */
if (!function_exists('GetYouTubeId')) {
    function GetYouTubeId($url)
    {
        $videoId = '';
        //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
        $finalUrl = '';
        if (strpos($url, 'facebook.com/') !== false) {
            //it is FB video
        } elseif (strpos($url, 'vimeo.com/') !== false) {
            //it is Vimeo video
            $videoId = explode("vimeo.com/", $url)[1];
            if (strpos($videoId, '&') !== false)
                $videoId = explode("&", $videoId)[0];
        } elseif (strpos($url, 'youtube.com/') !== false) {
            //it is Youtube video
            $videoId = explode("v=", $url)[1];
            if (strpos($videoId, '&') !== false)
                $videoId = explode("&", $videoId)[0];
        } elseif (strpos($url, 'youtu.be/') !== false) {
            //it is Youtube video
            $videoId = explode("youtu.be/", $url)[1];
            if (strpos($videoId, '&') !== false)
                $videoId = explode("&", $videoId)[0];
        }
        return $videoId;
    }
}


/*
 * Проверка на кол-во символов в телефоне
 */
if (!function_exists('IsCorrectMobilePhone')) {
    function IsCorrectMobilePhone($number)
    {
        $clearPhone = preg_replace("/[^0-9]/", '', $number);
        return strlen($clearPhone) === 11;
    }
}



function mb_ucfirst($str, $encoding='UTF-8')
{
    $str = mb_ereg_replace('^[\ ]+', '', $str);
    $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
        mb_substr($str, 1, mb_strlen($str), $encoding);
    return $str;
}


/*
* Сортировка многомерных массивов
*/

if (!function_exists('sortByOrder')) {
    function sortByOrder($a, $b) {
        if ($a['DATE_ACTIVE_FROM'] > $b['DATE_ACTIVE_FROM']) {
            return 1;
        } elseif ($a['DATE_ACTIVE_FROM'] < $b['DATE_ACTIVE_FROM']) {
            return -1;
        }
        return 0;
    }
}



usort($arr, 'sortByOrder');

function debug($data, $isHide = false)
{
    if ($isHide) {
        echo '<pre style="display: none">' . print_r($data, 1) . '</pre>';
        return;
    }

    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function checkNestedArrayWithId($items, $idToCheck) {
    if (array_key_exists($idToCheck, $items) && is_array($items[$idToCheck])) {
        return true;
    } else {
        return false;
    }
}
function findElementById($array, $id) {
    foreach ($array as $item) {
        foreach ($item as $key => $value) {
            if (is_array($value) && in_array($id, $value)) {
                return $item; // если найден элемент с нужным ID, возвращаем этот элемент
            }
        }
    }
    return null; // если элемент не найден, возвращаем null
}
function findElementIndexByID($array, $id) {
    foreach ($array as $index => $item) {
        if (isset($item['ID']) && $item['ID'] == $id) {
            return $index;
        }
    }
    return -1; // Возвращаем -1, если элемент не найден
}
function checkForId($array, $id) {
    foreach ($array as $item) {
        if ($item['ID'] == $id) {
            return true; // если найден элемент с нужным ID, возвращаем true
        }
    }
    return false; // если элемент не найден, возвращаем false
}