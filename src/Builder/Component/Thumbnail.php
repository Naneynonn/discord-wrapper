<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;

final class Thumbnail
{
  private string $url;
  private ?string $description = null;
  private ?bool $spoiler = null;
  private ?int $id = null;

  public function __construct(string $url)
  {
    $this->url = $url;
  }

  public static function create(string $url): self
  {
    return new self($url);
  }

  public function description(string $description): self
  {
    $this->description = $description;
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
      'type'  => ComponentType::THUMBNAIL->value,
      'media' => ['url' => $this->url],
    ];

    if ($this->description !== null) $data['description'] = $this->description;
    if ($this->spoiler !== null)     $data['spoiler'] = $this->spoiler;
    if ($this->id !== null)          $data['id'] = $this->id;

    return $data;
  }
}
