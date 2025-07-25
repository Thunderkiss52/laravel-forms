<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Illuminate\Support\Str;
use Thunderkiss52\LaravelForms\Interfaces\Element;
use Thunderkiss52\LaravelForms\Prototype\Input;

class BulletList extends Input implements Element
{
    public string $type = 'bulletlist';
    public function __construct(
        public string $label,
        public string $key,
        public bool $disabled = false,
        public array $visibleif = [],
        public array $displayifset = [],
        public ?array $fields = null,
        public ?string $prefix = null,
        public ?string $mask = null,
        public ?int $maxlength = null,
        public ?int $max = null,
        public ?string $placeholder = null,
        public ?string $icon = null,
        public bool $required = false
    ) {
    }
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'required' => $this->required,
            'mask' => $this->mask,
            'fields' => $this->fields,
            'maxlength' => $this->maxlength,
            'max' => $this->max,
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'icon' => $this->icon,
            'disabled' => $this->disabled,
            'key' => $this->key,
            'visibleif' => $this->visibleif,
            'displayifset' => $this->displayifset
        ];
    }
    public function getRawValue($label)
    {
        $values = explode(';', $label);
        $values = array_map('trim', $values);
        return $values;
    }
}