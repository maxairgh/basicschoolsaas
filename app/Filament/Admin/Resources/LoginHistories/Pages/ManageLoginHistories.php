<?php

namespace App\Filament\Admin\Resources\LoginHistories\Pages;

use App\Filament\Admin\Resources\LoginHistories\LoginHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageLoginHistories extends ManageRecords
{
    protected static string $resource = LoginHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
          //  CreateAction::make(),
        ];
    }
}
