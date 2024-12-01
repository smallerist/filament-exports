<?php

namespace SmallerId\FilamentExport\Tests\Filament\Resources\UserResource\Pages;

use SmallerId\FilamentExport\Tests\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
  protected static string $resource = UserResource::class;
}
