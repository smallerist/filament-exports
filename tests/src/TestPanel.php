<?php

namespace SmallerId\FilamentExport\Tests;

use Filament\Panel;
use Filament\PanelProvider;
use SmallerId\FilamentExport\Tests\Filament\Resources\PostResource;
use SmallerId\FilamentExport\Tests\Filament\Resources\UserResource;

class TestPanel extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('test-panel')
            ->default()
            ->resources([
                UserResource::class,
                PostResource::class,
            ]);
    }
}
