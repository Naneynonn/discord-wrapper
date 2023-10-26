<?php

namespace Naneynonn;

class RequestBuilder
{
  private array $params = [];
  private array $options = [];
  private array $externalOptions = [];
  private string $baseUrl = '';

  public function setBaseUrl(string $baseUrl): self
  {
    $this->baseUrl = $baseUrl;
    return $this;
  }

  public function setDefault(string $name, string $type): self
  {
    $this->params[$name] = [
      'type' => $type
    ];
    return $this;
  }

  public function withAuditLogReason(?string $reason): self
  {
    if ($reason) {
      $reason = rawurlencode($reason);
      $this->options[CURLOPT_HTTPHEADER][] = "X-Audit-Log-Reason: {$reason}";
    }
    return $this;
  }

  public function setOption($option, $value): self
  {
    $this->options[$option] = $value;
    return $this;
  }

  public function setExternalOptions(array $options): self
  {
    $this->externalOptions = $options;
    return $this;
  }

  public function getOptions(): array
  {
    return array_replace($this->externalOptions, $this->options);
  }

  public function buildUrl(array $inputParams = []): string
  {
    $processedParams = $this->process($inputParams);
    return $this->baseUrl . '?' . http_build_query($processedParams);
  }

  public function validateArray(array $inputParams = []): ?array
  {
    return $this->process($inputParams);
  }

  private function process(array $inputParams): array
  {
    $result = [];
    foreach ($this->params as $key => $settings) {
      if (isset($inputParams[$key]) && gettype($inputParams[$key]) === $settings['type']) {
        $result[$key] = $inputParams[$key];
      }
    }
    return $result;
  }
}
