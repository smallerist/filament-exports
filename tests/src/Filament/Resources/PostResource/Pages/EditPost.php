<?php

namespace SmallerId\FilamentExport\Tests\Filament\Resources\PostResource\Pages;

use SmallerId\FilamentExport\Tests\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
  protected static string $resource = PostResource::class;

  protected function getActions(): array
  {
    return [
      Actions\ViewAction::make(),
      Actions\DeleteAction::make(),
    ];
  }
}
