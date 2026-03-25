<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;

final class TextDisplay
{
  private string $content;
  private ?int $id = null;

  public function __construct(string $content)
  {
    $this->content = $content;
  }

  public static function create(string $content): self
  {
    return new self($content);
  }

  public function id(int $id): self
  {
    $this->id = $id;
    return $this;
  }

  public function toArray(): array
  {
    $data = [
      'type'    => ComponentType::TEXT_DISPLAY->value,
      'content' => $this->content,
    ];

    if ($this->id !== null) $data['id'] = $this->id;

    return $data;
  }
}
