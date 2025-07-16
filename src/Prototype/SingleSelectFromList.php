<?php
namespace Thunderkiss52\LaravelForms\Prototype;
use Illuminate\Contracts\Support\Arrayable;
use Thunderkiss52\LaravelForms\Elements\Option;
use Thunderkiss52\LaravelForms\Interfaces\Element;

class SingleSelectFromList extends Input implements Element {

    public string $label;
    /**
     * Summary of options
     * @var array<Option>
     */
    public array $options;

    public function toData($value): array {
        $opt = array_filter($this->options,fn(Option $option): bool => $option->value == $value);
        return [
            $this->label => count($opt) == 1 ? $opt[0]->value : $value
        ];
    }

    public function options(Arrayable|array $data): static {
        $this->options = is_array($data) ? $data : $data->toArray();
        return $this;
    }

    
    public function toArray(): array {
        return [
            'type' => 'select',
            'label' => $this->label,
            'options' => $this->options,
        ];
    }
}