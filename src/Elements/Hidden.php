<?php
namespace Thunderkiss52\LaravelForms\Elements;
use Thunderkiss52\LaravelForms\Interfaces\Element;
final class Hidden implements Element
{
    public string $type = 'hidden';
    public function __construct(
        public string $key,
        public ?string $label = null,
        public ?string $value = null,
        public bool $disabled = false,
        public bool $required = false
    ) {
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }

    public function toData($value): array
    {
        return [
            $this->label => $value
        ];
    }

    public function toArray(): array
    {
        return [
            'type' => 'hidden',
            'required' => $this->required,
            'disabled' => $this->disabled,
            'key' => $this->key,
            'value' => $this->value
        ];
    }
}
?>