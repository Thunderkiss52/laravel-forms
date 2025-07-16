<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Illuminate\Support\Str;
use Thunderkiss52\LaravelForms\Form;
use Thunderkiss52\LaravelForms\Interfaces\Element;
use Thunderkiss52\LaravelForms\Prototype\SingleSelectFromList;

final class Select extends SingleSelectFromList
{
    public string $type = 'select';
    public function __construct(
        public string $label,
        public string $key,
        public bool $disabled = false,
        public array $options = [],
        public array $visibleif = [],
        public array $displayifset = [],
        public ?string $placeholder = null,
        public bool $required = false,
        public ?string $icon = null
    ) {
    }
    public function toTableData()
    {
        return collect($this->options)->pluck('label');
    }
    public function toArray(): array
    {
        return [
            'type' => 'select',
            'disabled' => $this->disabled,
            'label' => $this->label,
            'icon' => $this->icon,
            'options' => $this->options,
            'required' => $this->required,
            'key' => $this->key,
            'visibleif' => $this->visibleif,
            'displayifset' => $this->displayifset
        ];
    }

    public function getRawValue($label)
    {
        $opt = collect($this->options)->filter(fn(Option $op) => Form::compareString(Str::lower($op->label)) == Form::compareString(trim(Str::lower($label))))->first();
        return $opt ? $opt->value : null;
    }
}