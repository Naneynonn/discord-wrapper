<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;

final class Container
{
  private array $components = [];
  private ?int $accentColor = null;
  private ?bool $spoiler = null;
  private ?int $id = null;

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

  public function accentColor(int $color): self
  {
    $this->accentColor = $color;
    return $this;
  }

  public function accentColorHex(string $hex): self
  {
    $this->accentColor = (int) hexdec(ltrim($hex, '#'));
    return $this;
  }

  public function spoiler(bool $spoiler = true): self
  {
    $this->spoiler = $spoiler;
    return $this;
  }

  public function id(int $id): self
  {
    $this->id = $id;
    return $this;
  }

  public function toArray(): array
  {
    $data = [
      'type'       => ComponentType::CONTAINER->value,
      'components' => $this->components,
    ];

    if ($this->accentColor !== null) $data['accent_color'] = $this->accentColor;
    if ($this->spoiler !== null)     $data['spoiler'] = $this->spoiler;
    if ($this->id !== null)          $data['id'] = $this->id;

    return $data;
  }
}
