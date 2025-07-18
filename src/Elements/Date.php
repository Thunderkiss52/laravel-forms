<?php

namespace Thunderkiss52\LaravelForms\Elements;

use Illuminate\Support\Str;
use Thunderkiss52\LaravelForms\Interfaces\Element;
use Carbon\Carbon;
use Thunderkiss52\LaravelForms\Prototype\Input;

final class Date extends Input implements Element
{
    public function toData($value): array
    {
        return [
            $this->label => $value ? 'Да' : 'Нет'
        ];
    }

    public function __construct(
        public string $label,
        public string $key,
        public ?string $type = 'date',
        public ?bool $disabled = false,
        public ?string $placeholder = null,
        public ?array $visibleif = [],
        public array $displayifset = [],
        public ?bool $holidays = true,
        public ?Carbon $mindate = null,
        public ?Carbon $maxdate = null,
        public ?string $default = null,
        public bool $required = false
    ) {
    }
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'required' => $this->required,
            'disabled' => $this->disabled,
            'label' => $this->label,
            'key' => $this->key,
            'visibleif' => $this->visibleif,
            'displayifset' => $this->displayifset,
            'holidays' => $this->holidays ?? true,
            'mindate' => $this->mindate ? $this->mindate->getTimestamp() : null,
            'maxdate' => $this->maxdate ? $this->maxdate->getTimestamp() : null,
            'default' => $this->default ?? null
        ];
    }
    public function getRawValue($label)
    {
        return Str::lower($label);
    }
}
