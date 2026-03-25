<?php

declare(strict_types=1);

namespace Naneynonn\Builder;

use Naneynonn\Enums\MessageFlag;

final class MessageBuilder
{
  private array $data = [];

  public static function create(): self
  {
    return new self();
  }

  public function content(string $content): self
  {
    $this->data['content'] = $content;
    return $this;
  }

  public function tts(bool $tts = true): self
  {
    $this->data['tts'] = $tts;
    return $this;
  }

  public function addEmbed(EmbedBuilder|array $embed): self
  {
    $this->data['embeds'][] = $embed instanceof EmbedBuilder ? $embed->toArray() : $embed;
    return $this;
  }

  public function addComponent(object|array $component): self
  {
    $this->data['components'][] = is_object($component) && method_exists($component, 'toArray')
      ? $component->toArray()
      : $component;
    return $this;
  }

  public function componentsV2(): self
  {
    $this->data['flags'] = ($this->data['flags'] ?? 0) | MessageFlag::IS_COMPONENTS_V2->value;
    return $this;
  }

  public function toArray(): array
  {
    return $this->data;
  }
}
