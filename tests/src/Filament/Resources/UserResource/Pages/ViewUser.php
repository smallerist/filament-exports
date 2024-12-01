<?php

namespace SmallerId\FilamentExport\Tests\Filament\Resources\UserResource\Pages;

use SmallerId\FilamentExport\Tests\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
  protected static string $resource = UserResource::class;

  protected function getActions(): array
  {
    return [
      Actions\EditAction::make(),
    ];
  }
}
