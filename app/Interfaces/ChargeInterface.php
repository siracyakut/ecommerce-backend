<?php

namespace App\Interfaces;

interface ChargeInterface
{
    public function list_all();
    public function create($amount);
}
