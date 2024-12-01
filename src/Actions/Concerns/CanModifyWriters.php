<?php

namespace SmallerId\FilamentExport\Actions\Concerns;

use Closure;

trait CanModifyWriters
{
  protected ?Closure $modifyExcelWriter = null;

  protected ?Closure $modifyPdfWriter = null;

  protected ?Closure $modifyDocxWriter = null;

  public function modifyPdfWriter(?Closure $modifyPdfWriter): static
  {
    $this->modifyPdfWriter = $modifyPdfWriter;

    return $this;
  }

  public function modifyExcelWriter(?Closure $modifyExcelWriter): static
  {
    $this->modifyExcelWriter = $modifyExcelWriter;

    return $this;
  }

  public function getModifyPdfWriter(): ?Closure
  {
    return $this->modifyPdfWriter;
  }

  public function getModifyExcelWriter(): ?Closure
  {
    return $this->modifyExcelWriter;
  }

  public function getModifyDocxWriter(): ?Closure
  {
    return $this->modifyDocxWriter;
  }

  public function modifyDocxWriter(?Closure $modifyDocxWriter): self
  {
    $this->modifyDocxWriter = $modifyDocxWriter;
    return $this;
  }
}
