<?php
namespace Thunderkiss52\LaravelForms\Interfaces;
use Illuminate\Contracts\Support\Arrayable;
interface Element extends Arrayable
{
    public function toData($value): array;
    // public function getRawValue(string $label);
}