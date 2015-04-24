<?php

namespace T4webLists\ObjectList;

use T4webBase\Domain\Enum;

class Type extends Enum
{

    const BASE = 1;

    /**
     * @var array
     */
    protected static $constants = array(
        self::BASE => 'default',
    );

}