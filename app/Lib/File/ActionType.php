<?php
namespace App\Lib\File;

abstract class ActionType
{
    const NONE = -1;
    const PUTFILE = 0;
    const POSTFILE = 1;
    const MINIT = 2;
    const MUPLOAD = 3;
    const MFINISH = 4;
    const MCANCEL = 5;
    const DELETE = 6;
    const UPLOADHIT = 7;
    const GETFILE = 8;
    const NO_AUTH_CHECK = 0;
    const HEAD_FIELD_CHECK = 1;
    const QUERY_STRING_CHECK = 2;
}

