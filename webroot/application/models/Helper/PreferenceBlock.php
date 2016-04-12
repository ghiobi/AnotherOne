<?php

namespace Scheduler;

/**
 * Class PreferenceBlock holds data of time.
 *
 * @package Scheduler
 */
class PreferenceBlock extends Block
{
    public function __construct($start, $end, $weekday)
    {
        parent::__construct($start, $end, $weekday);
    }
}