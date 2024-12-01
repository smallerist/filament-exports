<?php

namespace SmallerId\FilamentExport\Actions;

use SmallerId\FilamentExport\Actions\Concerns\CanDisableFileName;
use SmallerId\FilamentExport\Actions\Concerns\CanDisableAdditionalColumns;
use SmallerId\FilamentExport\Actions\Concerns\CanDisableFileNamePrefix;
use SmallerId\FilamentExport\Actions\Concerns\CanDisableFilterColumns;
use SmallerId\FilamentExport\Actions\Concerns\CanDisableFormats;
use SmallerId\FilamentExport\Actions\Concerns\CanDisablePreview;
use SmallerId\FilamentExport\Actions\Concerns\CanDisableTableColumns;
use SmallerId\FilamentExport\Actions\Concerns\CanDownloadDirect;
use SmallerId\FilamentExport\Actions\Concerns\CanFormatStates;
use SmallerId\FilamentExport\Actions\Concerns\CanHaveExtraColumns;
use SmallerId\FilamentExport\Actions\Concerns\CanHaveExtraViewData;
use SmallerId\FilamentExport\Actions\Concerns\CanModifyWriters;
use SmallerId\FilamentExport\Actions\Concerns\CanRefreshTable;
use SmallerId\FilamentExport\Actions\Concerns\CanShowHiddenColumns;
use SmallerId\FilamentExport\Actions\Concerns\CanUseSnappy;
use SmallerId\FilamentExport\Actions\Concerns\HasAdditionalColumnsField;
use SmallerId\FilamentExport\Actions\Concerns\HasDefaultFormat;
use SmallerId\FilamentExport\Actions\Concerns\HasDefaultPageOrientation;
use SmallerId\FilamentExport\Actions\Concerns\HasExportModelActions;
use SmallerId\FilamentExport\Actions\Concerns\HasFileName;
use SmallerId\FilamentExport\Actions\Concerns\HasFileNameField;
use SmallerId\FilamentExport\Actions\Concerns\HasFilterColumnsField;
use SmallerId\FilamentExport\Actions\Concerns\HasFormatField;
use SmallerId\FilamentExport\Actions\Concerns\HasPageOrientationField;
use SmallerId\FilamentExport\Actions\Concerns\HasPaginator;
use SmallerId\FilamentExport\Actions\Concerns\HasRecords;
use SmallerId\FilamentExport\Actions\Concerns\HasTimeFormat;
use SmallerId\FilamentExport\Actions\Concerns\HasUniqueActionId;
use SmallerId\FilamentExport\Actions\Concerns\HasCsvDelimiter;
use SmallerId\FilamentExport\FilamentExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilamentExportHeaderAction extends \Filament\Tables\Actions\Action
{
  use CanDisableAdditionalColumns;
  use CanDisableFileName;
  use CanDisableFileNamePrefix;
  use CanDisableFilterColumns;
  use CanDisableFormats;
  use CanDisablePreview;
  use CanDisableTableColumns;
  use CanDownloadDirect;
  use CanFormatStates;
  use CanHaveExtraColumns;
  use CanHaveExtraViewData;
  use CanModifyWriters;
  use CanShowHiddenColumns;
  use CanUseSnappy;
  use CanRefreshTable;
  use HasAdditionalColumnsField;
  use HasCsvDelimiter;
  use HasDefaultFormat;
  use HasDefaultPageOrientation;
  use HasExportModelActions;
  use HasFileName;
  use HasFileNameField;
  use HasFilterColumnsField;
  use HasFormatField;
  use HasPageOrientationField;
  use HasPaginator;
  use HasRecords;
  use HasTimeFormat;
  use HasUniqueActionId;

  protected function setUp(): void
  {
    parent::setUp();

    $this->uniqueActionId('header-action');

    FilamentExport::setUpFilamentExportAction($this);

    $this
      ->modalHeading(static function ($action)
      {
        if ($action->shouldDownloadDirect())
        {
          return false;
        }
        return $action;
      })
      ->form(static function ($action, $livewire): array
      {
        if ($action->shouldDownloadDirect())
        {
          return [];
        }

        $action->paginator($action->getTableQuery()->paginate(
          perPage: $livewire->tableRecordsPerPage === 'all' ? $action->getTableQuery()->count() : $livewire->tableRecordsPerPage,
          pageName: 'exportPage'
        ));

        return FilamentExport::getFormComponents($action);
      })
      ->action(static function ($action, $data): StreamedResponse
      {
        $action->fillDefaultData($data);

        $records = $action->getRecords();

        return FilamentExport::callDownload($action, $records, $data);
      });
  }
}
