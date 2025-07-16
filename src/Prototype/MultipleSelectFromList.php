<?php
namespace Thunderkiss52\LaravelForms\Prototype;
use Illuminate\Contracts\Support\Arrayable;
use Thunderkiss52\LaravelForms\Elements\Option;
use Thunderkiss52\LaravelForms\Interfaces\Element;

class MultipleSelectFromList extends Input implements Element
{

    public string $label;
    /**
     * Summary of options
     * @var array<Option>
     */
    public array $options;
    /**
     * Summary of toData
     * @param array<int> $values
     * @return array
     */
    public function toData($values): array
    {
        $opt = array_filter($this->options, fn(Option $option): bool => in_array($option->value, $values));
        $result = [];
        foreach ($opt as $option) {
            $result[] = "{$option->label}, ";
        }

        return [
            $this->label => $result
        ];
    }

    public function options(Arrayable|array $data): static
    {
        $this->options = is_array($data) ? $data : $data->toArray();
        return $this;
    }


    public function toArray(): array
    {
        return [
            'type' => 'select',
            'label' => $this->label,
            'options' => $this->options,
        ];
    }
}