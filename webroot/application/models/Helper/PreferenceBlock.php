<?php

namespace Scheduler;


class PreferenceBlock extends Block
{
    public function __construct($start, $end, $weekday)
    {
        parent::__construct($start, $end, $weekday);
    }
}