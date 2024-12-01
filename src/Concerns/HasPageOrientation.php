<?php

namespace SmallerId\FilamentExport\Concerns;

use SmallerId\FilamentExport\FilamentExport;

trait HasPageOrientation
{
  protected string $pageOrientation;

  public function pageOrientation(string $pageOrientation): static
  {
    if (!array_key_exists($pageOrientation, FilamentExport::getPageOrientations()))
    {
      return $this;
    }

    $this->pageOrientation = $pageOrientation;

    return $this;
  }

  public function getPageOrientation(): string
  {
    return $this->pageOrientation;
  }

  public static function getPageOrientations(): array
  {
    return [
      'portrait' => __('filament-export::export_action.page_orientation_portrait'),
      'landscape' => __('filament-export::export_action.page_orientation_landscape'),
    ];
  }
}
