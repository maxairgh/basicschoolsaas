<?php

namespace App\Filament\Admin\Resources\Schools\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serial')
                    ->searchable(),
                TextColumn::make('school_name')
                    ->searchable(),
                TextColumn::make('mobile_number')
                    ->searchable(),
                TextColumn::make('email_address')
                    ->searchable(),
                TextColumn::make('tag_line')
                    ->searchable(),
                TextColumn::make('postal_address')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('digital_address')
                    ->searchable(),
                TextColumn::make('school_type')
                    ->searchable(),
                TextColumn::make('head_signature')
                    ->searchable(),
                TextColumn::make('school_badge')
                    ->searchable(),
                TextColumn::make('head_name')
                    ->searchable(),
                TextColumn::make('head_title')
                    ->searchable(),
                TextColumn::make('id_prefix')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('service_name')
                    ->searchable(),
                TextColumn::make('region_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('district_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
