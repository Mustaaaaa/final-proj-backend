<?php

if (!function_exists('formatItalianDate')) {
    function formatItalianDate($date) {
        return \Carbon\Carbon::parse($date)->format('d-m-Y') . ' alle ' . \Carbon\Carbon::parse($date)->format('H:i');
    }
}