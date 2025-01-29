<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('addresses.city.state.country.name')
                    ->label('País')
                    ->searchable(),
                TextColumn::make('events_count')
                    ->label('Eventos que participou')
                    ->badge()
                    ->color(function (string $state) {
                       if ($state < 5) {
                           return 'gray';
                       }
                       return 'success';
                    })
                    ->counts([
                        'events' => fn (Builder $query): Builder => $query->whereNotNull('event_user.checkin_at')
                    ]),
                TextColumn::make('created_at')
                    ->date("d F Y"),
                Tables\Columns\ViewColumn::make('teste')->view('filament.tables.columns.custom-column')
            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->label("Tipo")
                    ->relationship('role', 'name'),
                Tables\Filters\QueryBuilder::make()
                    ->constraints([
                        Tables\Filters\QueryBuilder\Constraints\DateConstraint::make('created_at')
                            ->label('Data de criação'),
                        Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint::make('events')
                            ->relationship('events', 'name')->multiple()
                    ])
            ])
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
