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