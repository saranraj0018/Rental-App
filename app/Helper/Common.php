<?php


function hubList(): array
{
    return ['632' => 'coimbatore'];
}

function formDate($date, $format = 'Y-m-d')
{
    return \Illuminate\Support\Carbon::parse($date)->format($format);
}

function block_type(): array
{
    return ['0' => 'Maintenance','1' => 'Discretionary','2' => 'Availability Type','3' => 'U-refurbish',
        '4' => 'U-recovery','5' => 'It-reserve'
        ];
}

function reason_type(): array
{
    return ['0' => 'Major Repair','1' => 'Accident','2' => 'Running Repair','3' => 'Service',
        '4' => 'Others','5' => 'Buffer','6' => 'GPS-Issue','7' => 'Forced-Extension','8' => 'Others'
    ];
}
