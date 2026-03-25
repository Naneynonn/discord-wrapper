<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;

final class Section
{
  private array $components = [];
  private ?array $accessory = null;
  private ?int $id = null;

  public static function create(): self
  {
    return new self();
  }

  public function addText(TextDisplay|string $text): self
  {
    $this->components[] = $text instanceof TextDisplay
      ? $text->toArray()
      : TextDisplay::create($text)->toArray();
    return $this;
  }

  public function accessory(object|array $accessory): self
  {
    $this->accessory = is_object($accessory) && method_exists($accessory, 'toArray')
      ? $accessory->toArray()
      : $accessory;
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
      'type'       => ComponentType::SECTION->value,
      'components' => $this->components,
    ];

    if ($this->accessory !== null) $data['accessory'] = $this->accessory;
    if ($this->id !== null)        $data['id'] = $this->id;

    return $data;
  }
}
