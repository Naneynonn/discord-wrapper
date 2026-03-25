<?php

declare(strict_types=1);

namespace Naneynonn\Webhook;

use Naneynonn\Builder\EmbedBuilder;
use Naneynonn\Enums\MessageFlag;

final class WebhookMessage
{
  private ?string $content = null;
  private ?string $username = null;
  private ?string $avatarUrl = null;
  private bool $tts = false;
  private array $embeds = [];
  private array $components = [];
  private ?int $flags = null;
  private ?string $threadName = null;

  public static function create(): self
  {
    return new self();
  }

  public function content(string $content): self
  {
    $this->content = $content;
    return $this;
  }

  public function username(string $username): self
  {
    $this->username = $username;
    return $this;
  }

  public function avatarUrl(string $url): self
  {
    $this->avatarUrl = $url;
    return $this;
  }

  public function tts(bool $tts = true): self
  {
    $this->tts = $tts;
    return $this;
  }

  public function addEmbed(EmbedBuilder|array $embed): self
  {
    $this->embeds[] = $embed instanceof EmbedBuilder
      ? $embed->toArray()
      : $embed;
    return $this;
  }

  public function addComponent(object|array $component): self
  {
    $this->components[] = is_object($component) && method_exists($component, 'toArray')
      ? $component->toArray()
      : $component;
    return $this;
  }

  public function componentsV2(): self
  {
    $this->flags = ($this->flags ?? 0) | MessageFlag::IS_COMPONENTS_V2->value;
    return $this;
  }

  public function threadName(string $name): self
  {
    $this->threadName = $name;
    return $this;
  }

  // public function toArray(): array
  // {
  //   $data = [];

  //   if ($this->content !== null)    $data['content']     = $this->content;
  //   if ($this->username !== null)   $data['username']    = $this->username;
  //   if ($this->avatarUrl !== null)  $data['avatar_url']  = $this->avatarUrl;
  //   if ($this->tts)                 $data['tts']         = true;
  //   if (!empty($this->embeds))      $data['embeds']      = $this->embeds;
  //   if (!empty($this->components))  $data['components']  = $this->components;
  //   if ($this->flags !== null)      $data['flags']       = $this->flags;
  //   if ($this->threadName !== null) $data['thread_name'] = $this->threadName;

  //   return $data;
  // }
  public function toArray(): array
  {
    $data = [];
    $isV2 = ($this->flags !== null) && ($this->flags & MessageFlag::IS_COMPONENTS_V2->value);

    // V2 mode — content и embeds запрещены Discord API
    if (!$isV2) {
      if ($this->content !== null) $data['content'] = $this->content;
      if (!empty($this->embeds))   $data['embeds'] = $this->embeds;
    }

    if ($this->username !== null)   $data['username'] = $this->username;
    if ($this->avatarUrl !== null)   $data['avatar_url'] = $this->avatarUrl;
    if ($this->tts)                 $data['tts'] = true;
    if (!empty($this->components))  $data['components'] = $this->components;
    if ($this->flags !== null)      $data['flags'] = $this->flags;
    if ($this->threadName !== null)  $data['thread_name'] = $this->threadName;

    return $data;
  }
}
