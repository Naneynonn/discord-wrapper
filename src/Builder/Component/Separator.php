<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;
use Naneynonn\Enums\SeparatorSpacing;

final class Separator
{
  private bool $divider = true;
  private ?SeparatorSpacing $spacing = null;
  private ?int $id = null;

  public static function create(): self
  {
    return new self();
  }

  public function divider(bool $divider): self
  {
    $this->divider = $divider;
    return $this;
  }

  public function spacing(SeparatorSpacing $spacing): self
  {
    $this->spacing = $spacing;
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
      'type'    => ComponentType::SEPARATOR->value,
      'divider' => $this->divider,
    ];

    if ($this->spacing !== null) $data['spacing'] = $this->spacing->value;
    if ($this->id !== null)      $data['id'] = $this->id;

    return $data;
  }
}
