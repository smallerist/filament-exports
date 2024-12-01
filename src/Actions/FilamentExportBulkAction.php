<?php

namespace SmallerId\FilamentExport\Actions;

use SmallerId\FilamentExport\Actions\Concerns\CanDisableAdditionalColumns;
use SmallerId\FilamentExport\Actions\Concerns\CanDisableFileName;
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
use SmallerId\FilamentExport\Actions\Concerns\HasTimeFormat;
use SmallerId\FilamentExport\Actions\Concerns\HasUniqueActionId;
use SmallerId\FilamentExport\Actions\Concerns\HasCsvDelimiter;
use SmallerId\FilamentExport\FilamentExport;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FilamentExportBulkAction extends \Filament\Tables\Actions\BulkAction
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
  use CanRefreshTable;
  use CanShowHiddenColumns;
  use CanUseSnappy;
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
  use HasTimeFormat;
  use HasUniqueActionId;

  protected function setUp(): void
  {
    parent::setUp();

    $this->uniqueActionId('bulk-action');

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
      ->form(static function ($action, $records, $livewire): array
      {
        if ($action->shouldDownloadDirect())
        {
          return [];
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage('exportPage');
        $perPage = $livewire->tableRecordsPerPage === 'all' ? $records->count() : $livewire->tableRecordsPerPage;

        $paginator = new LengthAwarePaginator($records->forPage($currentPage, $perPage), $records->count(), $perPage, $currentPage, [
          'pageName' => 'exportPage',
        ]);

        $action->paginator($paginator);

        return FilamentExport::getFormComponents($action);
      })
      ->action(static function ($action, $records, $data): StreamedResponse
      {
        $action->fillDefaultData($data);

        return FilamentExport::callDownload($action, $records, $data);
      });
  }
}
