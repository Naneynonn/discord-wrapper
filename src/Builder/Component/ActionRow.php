<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;

final class ActionRow
{
  private array $components = [];

  public static function create(): self
  {
    return new self();
  }

  public function addComponent(object|array $component): self
  {
    $this->components[] = is_object($component) && method_exists($component, 'toArray')
      ? $component->toArray()
      : $component;
    return $this;
  }

  public function toArray(): array
  {
    return [
      'type'       => ComponentType::ACTION_ROW->value,
      'components' => $this->components,
    ];
  }
}
