<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;

final class MediaGallery
{
  private array $items = [];
  private ?int $id = null;

  public static function create(): self
  {
    return new self();
  }

  public function addItem(string $url, ?string $description = null, bool $spoiler = false): self
  {
    $item = ['media' => ['url' => $url]];
    if ($description !== null) $item['description'] = $description;
    if ($spoiler) $item['spoiler'] = true;

    $this->items[] = $item;
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
      'type'  => ComponentType::MEDIA_GALLERY->value,
      'items' => $this->items,
    ];

    if ($this->id !== null) $data['id'] = $this->id;

    return $data;
  }
}
