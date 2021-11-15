<?php

use App\Supports\Facades\HashIdFacade;

/**
 * encode Id
*/
if (!function_exists('encodeId')) {
    function encodeId($id) {
        return HashIdFacade::encode($id);
    }
}

/**
 * decode Id
 */
if (!function_exists('decodeId')) {
    function decodeId($id) {
        return HashIdFacade::decode($id);
    }
}