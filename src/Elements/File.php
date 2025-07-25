<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Thunderkiss52\LaravelForms\Interfaces\Element;
use Thunderkiss52\LaravelForms\Prototype\Input;

class File extends Input implements Element
{
    public string $type = 'file';
    public function __construct(
        public string $label,
        public string $key,
        public ?string $accept = null,
        public bool $disabled = false,
        public array $displayifset = [],
        public array $visibleif = [],
        public bool $required = false
    ) {
    }
    public function toArray(): array
    {
        return [
            'type' => 'file',
            'required' => $this->required,
            'label' => $this->label,
            'accept' => $this->accept,
            'disabled' => $this->disabled,
            'key' => $this->key,
            'visibleif' => $this->visibleif,
            'displayifset' => $this->displayifset
        ];
    }
}