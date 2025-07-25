<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Illuminate\Support\Str;
use Thunderkiss52\LaravelForms\Form;
use Thunderkiss52\LaravelForms\Prototype\MultipleSelectFromList;

final class MultipleSelect extends MultipleSelectFromList
{
    public string $type = 'select';
    public function __construct(
        public string $label,
        public string $key,
        public bool $checkboxes = false,
        public bool $disabled = false,
        public array $options = [],
        public array $displayifset = [],
        public array $visibleif = [],
        public ?string $placeholder = null,
        public bool $required = false,
        public ?string $icon = null
    ) {
    }

    public function toArray(): array
    {
        return [
            'type' => 'select',
            'multiple' => true,
            'disabled' => $this->disabled,
            'required' => $this->required,
            'checkboxes' => $this->checkboxes,
            'label' => $this->label,
            'icon' => $this->icon,
            'options' => $this->options,
            'key' => $this->key,
            'displayifset' => $this->displayifset,
            'visibleif' => $this->visibleif
        ];
    }
    public function getRawValue($label)
    {
        $values = explode(';', $label);
        $values = array_map('trim', $values);
        $values = array_map('mb_strtolower', $values);
        $values = array_map(fn($value) => Form::compareString($value), $values);
        return collect($this->options)
            ->filter(fn(Option $op) => in_array(Form::compareString(Str::lower($op->label)), $values))
            ->values()
            ->map(fn(Option $op) => $op->value)
            ->all();
    }
}