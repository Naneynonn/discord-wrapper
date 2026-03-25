<?php

declare(strict_types=1);

namespace Naneynonn\Builder\Component;

use Naneynonn\Enums\ComponentType;
use Naneynonn\Enums\ButtonStyle;

final class Button
{
  private ButtonStyle $style;
  private ?string $label = null;
  private ?string $customId = null;
  private ?string $url = null;
  private ?bool $disabled = null;
  private ?int $id = null;

  public function __construct(ButtonStyle $style)
  {
    $this->style = $style;
  }

  public static function primary(string $customId, string $label): self
  {
    return (new self(ButtonStyle::Primary))->customId($customId)->label($label);
  }

  public static function secondary(string $customId, string $label): self
  {
    return (new self(ButtonStyle::Secondary))->customId($customId)->label($label);
  }

  public static function success(string $customId, string $label): self
  {
    return (new self(ButtonStyle::Success))->customId($customId)->label($label);
  }

  public static function danger(string $customId, string $label): self
  {
    return (new self(ButtonStyle::Danger))->customId($customId)->label($label);
  }

  public static function link(string $url, string $label): self
  {
    return (new self(ButtonStyle::Link))->url($url)->label($label);
  }

  public function label(string $label): self
  {
    $this->label = $label;
    return $this;
  }

  public function customId(string $customId): self
  {
    $this->customId = $customId;
    return $this;
  }

  public function url(string $url): self
  {
    $this->url = $url;
    return $this;
  }

  public function disabled(bool $disabled = true): self
  {
    $this->disabled = $disabled;
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
      'type'  => ComponentType::BUTTON->value,
      'style' => $this->style->value,
    ];

    if ($this->label !== null)    $data['label'] = $this->label;
    if ($this->customId !== null) $data['custom_id'] = $this->customId;
    if ($this->url !== null)      $data['url'] = $this->url;
    if ($this->disabled !== null) $data['disabled'] = $this->disabled;
    if ($this->id !== null)       $data['id'] = $this->id;

    return $data;
  }
}
