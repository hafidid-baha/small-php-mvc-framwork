<?php
namespace MVCF\LIB;

class helper{

    public static function filterInt($input)
    {
        return filter_var($input,FILTER_SANITIZE_NUMBER_INT);
    }

    public static function filterStr($input)
    {
        return filter_var($input,FILTER_SANITIZE_STRING);
    }
}