<?php

namespace SmallerId\FilamentExport\Actions\Concerns;

use SmallerId\FilamentExport\FilamentExport;

trait HasDefaultFormat
{
  protected string $defaultFormat;

  public function defaultFormat(string $defaultFormat): static
  {
    if (!array_key_exists($defaultFormat, FilamentExport::DEFAULT_FORMATS))
    {
      return $this;
    }

    $this->defaultFormat = $defaultFormat;

    return $this;
  }

  public function getDefaultFormat(): string
  {
    return $this->defaultFormat;
  }
}
