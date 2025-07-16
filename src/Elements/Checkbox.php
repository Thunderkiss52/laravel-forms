<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Illuminate\Support\Str;
use Thunderkiss52\LaravelForms\Interfaces\Element;
use Thunderkiss52\LaravelForms\Prototype\Input;

final class Checkbox extends Input implements Element
{
    public string $type = 'checkbox';
    public function toData($value): array
    {
        return [
            $this->label => $value ? 'Да' : 'Нет'
        ];
    }

    public function __construct(
        public string $label,
        public string $key,
        public bool $disabled = false,
        public ?string $placeholder = null,
        public array $visibleif = [],
        public array $displayifset = [],
        public bool $required = false
    ) {
    }
    public function toArray(): array
    {
        return [
            'type' => 'checkbox',
            'required' => $this->required,
            'disabled' => $this->disabled,
            'label' => $this->label,
            'key' => $this->key,
            'visibleif' => $this->visibleif,
            'displayifset' => $this->displayifset
        ];
    }
    public function getRawValue($label)
    {
        return Str::lower($label);
    }
}