<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Thunderkiss52\LaravelForms\Interfaces\Element;
use Thunderkiss52\LaravelForms\Prototype\Input;

class FileList extends Input implements Element
{
    public string $type = 'filelist';
    public function __construct(
        public string $label,
        public string $key,
        public string $source,
        public int $limit = 1,
        public ?array $accept = null,
        public array $displayifset = [],
        public array $visibleif = [],
        public bool $required = false
    ) {
    }
    public function toArray(): array
    {
        return [
            'type' => 'filelist',
            'required' => $this->required,
            'label' => $this->label,
            'accept' => $this->accept,
            'source' => $this->source,
            'limit' => $this->limit,
            'key' => $this->key,
            'visibleif' => $this->visibleif,
            'displayifset' => $this->displayifset
        ];
    }
}