<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EventResource\Pages;
use App\Filament\Admin\Resources\EventResource\RelationManagers;
use App\Filament\FormGroups\AddressFormGroup;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $title = "Evento";
    protected static ?string $modelLabel = "Evento";
    protected static ?string $pluralLabel = "Eventos";

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([

                    Forms\Components\Fieldset::make('Dados do evento')
                        ->schema([
                            Forms\Components\Select::make('event_status_id')
                                ->relationship('eventStatus', 'name')
                                ->required()
                                ->columnSpan(2),
                            Forms\Components\Select::make('event_type_id')
                                ->relationship('eventType', 'name')
                                ->required()
                                ->columnSpan(2),
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(3),
                            Forms\Components\DateTimePicker::make('schedule')
                                ->required()
                                ->columnSpan(1),
                            Forms\Components\RichEditor::make('description')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('cover')
                                ->required()
                                ->image()
                                ->maxSize('10000000')
                                ->columnSpanFull(),
                        ])
                        ->columns(4),
                    Forms\Components\Fieldset::make('address')
                        ->relationship('address')
                        ->schema(AddressFormGroup::make($form))
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('eventStatus.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('eventType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cover')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
            RelationManagers\AttractionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
