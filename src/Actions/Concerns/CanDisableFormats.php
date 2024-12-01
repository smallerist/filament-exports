<?php

namespace SmallerId\FilamentExport\Actions\Concerns;

use SmallerId\FilamentExport\FilamentExport;

trait CanDisableFormats
{
  protected array $formats = FilamentExport::DEFAULT_FORMATS;

  public function disablePdf(): static
  {
    unset($this->formats[FilamentExport::PDF]);

    return $this;
  }

  public function disableXlsx(): static
  {
    unset($this->formats[FilamentExport::XLSX]);

    return $this;
  }

  public function disableCsv(): static
  {
    unset($this->formats[FilamentExport::CSV]);

    return $this;
  }

  public function disableDocx(): static
  {
    unset($this->formats[FilamentExport::DOCX]);

    return $this;
  }

  public function disabledFormat(string $format): static
  {
    unset($this->formats[$format]);

    return $this;
  }

  public function getFormats(): array
  {
    if (!empty($this->formats))
    {
      return $this->formats;
    }

    return FilamentExport::DEFAULT_FORMATS;
  }
}
