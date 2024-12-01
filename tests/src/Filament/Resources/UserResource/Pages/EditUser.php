<?php

namespace SmallerId\FilamentExport\Tests\Filament\Resources\UserResource\Pages;

use SmallerId\FilamentExport\Tests\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
  protected static string $resource = UserResource::class;

  protected function getActions(): array
  {
    return [
      Actions\ViewAction::make(),
      Actions\DeleteAction::make(),
    ];
  }
}
