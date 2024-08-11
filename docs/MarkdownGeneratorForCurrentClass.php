<?php

require '../vendor/autoload.php';

use Naneynonn\Rest\Voice;

class MarkdownGeneratorForCurrentClass
{
  private \ReflectionClass $reflectionClass;
  private string $markdown;

  public function __construct(string $className)
  {
    $this->reflectionClass = new \ReflectionClass($className);
    $this->markdown = '';
  }

  public function generate(): string
  {
    $methods = $this->reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

    foreach ($methods as $method) {
      if ($method->getName() !== '__construct') {
        $this->addTitle($method);
        // $this->addRequiredIntents($method);
        $this->addProperties($method);
        $this->addHowToUse($method);
      }
    }

    return $this->markdown;
  }

  private function addTitle(\ReflectionMethod $method): void
  {
    $methodName = $this->splitCamelCase($method->getName());
    $this->markdown .= "### " . $methodName . "\n\n";
  }

  private function addRequiredIntents(\ReflectionMethod $method): void
  {
    $this->markdown .= "#### Required Permission\n\n";
    $this->markdown .= "- `PERMISSION_NAME`  \n\n"; // Placeholder for user to fill in.
  }

  private function addProperties(\ReflectionMethod $method): void
  {
    $this->markdown .= "#### Properties\n\n";
    $this->markdown .= "| property | type |\n";
    $this->markdown .= "|----------|------|\n";

    foreach ($method->getParameters() as $param) {
      $paramType = $param->getType() ? $param->getType() : 'mixed';
      $paramName = $param->getName();
      $this->markdown .= "| `$paramName` | `$paramType` |\n"; // Description left blank for manual entry
    }

    $this->markdown .= "\n";
  }

  private function addHowToUse(\ReflectionMethod $method): void
  {
    $classNameLower = strtolower($this->reflectionClass->getShortName());
    $methodName = $method->getName();

    $this->markdown .= "#### How to use\n\n";
    $this->markdown .= "```php\n";
    $this->markdown .= "\$$classNameLower = \$api->$classNameLower->$methodName(";

    $parameters = [];
    foreach ($method->getParameters() as $param) {
      $paramName = $param->getName();
      if ($paramName !== 'cache_ttl') { // Exclude cache_ttl parameter
        $value = $this->getParameterValue($param);
        $parameters[] = "$paramName: $value";
      }
    }

    $this->markdown .= implode(', ', $parameters);
    $this->markdown .= ");\n";
    $this->markdown .= "```\n\n";
  }

  private function getParameterValue(\ReflectionParameter $param): string
  {
    if ($param->hasType()) {
      $type = $param->getType();
      if (!$type->isBuiltin()) {
        return $param->getName(); // Assume it's a class and just use the variable name
      }

      switch ((string) $type) {
        case 'array':
          return '[]';
        case 'bool':
          return 'true'; // or 'false', depending on your use case
        case 'int':
          return '0';
        case 'float':
          return '0.0';
        case 'string':
          return "'{$param->getName()}'";
        default:
          return 'null';
      }
    }

    return 'null'; // default fallback
  }


  private function splitCamelCase(string $input): string
  {
    return ucwords(preg_replace('/(?<!^)[A-Z]/', ' $0', $input));
  }
}

// Использование генератора Markdown в конце вашего PHP файла.
$cln = Voice::class;
$generator = new MarkdownGeneratorForCurrentClass($cln);
$markdownDocumentation = $generator->generate();
$markdownFilename = $cln . '_Documentation.md';
file_put_contents($markdownFilename, $markdownDocumentation);
echo "Markdown documentation for " . $cln . " has been generated in $markdownFilename\n";
