<?php

namespace SmallerId\FilamentExport\Components\Concerns;

use SmallerId\FilamentExport\Actions\FilamentExportBulkAction;
use SmallerId\FilamentExport\Actions\FilamentExportHeaderAction;

trait HasAction
{
  protected FilamentExportBulkAction|FilamentExportHeaderAction $action;

  public function action(FilamentExportBulkAction|FilamentExportHeaderAction $action): static
  {
    $this->action = $action;

    $this->getExport()->fileName($this->getAction()->getFileName());

    $this->getExport()->table($this->getAction()->getTable());

    return $this;
  }

  public function getAction(): FilamentExportBulkAction|FilamentExportHeaderAction
  {
    return $this->action;
  }
}
