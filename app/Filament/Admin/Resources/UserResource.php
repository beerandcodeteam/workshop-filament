<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Filament\FormGroups\AddressFormGroup;
use App\Models\City;
use App\Models\Role;
use App\Models\State;
use App\Models\User;
use App\Services\AddressServices;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\Fieldset::make('Papel')
                    ->schema([
                        Forms\Components\ToggleButtons::make('role_id')
                            ->hiddenLabel()
                            ->required()
                            ->options(Role::all()->sortBy('name')->pluck('name', 'id'))
                            ->default(2)
                            ->grouped(),
                    ]),
                    Forms\Components\Fieldset::make('Papel')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nome')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                            Forms\Components\TextInput::make('password')
                                ->label('Senha')
                                ->required()
                                ->maxLength(255)
                                ->confirmed()
                                ->rules([Password::min(8)->mixedCase()->numbers()->uncompromised()])
                                ->password()
                                ->revealable(),
                            Forms\Components\TextInput::make('password_confirmation')
                                ->label('Confirme a Senha')
                                ->required()
                                ->maxLength(255)
                                ->password()
                                ->revealable(),
                    ]),
                    Forms\Components\Fieldset::make('Dados de endereço')
                        ->schema([
                            Forms\Components\Repeater::make('addresses')
                                ->hiddenLabel()
                                ->relationship()
                                ->schema(AddressFormGroup::make($form))
                        ])->columns(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label("Nome")
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label("E-mail")
                    ->searchable(),
                Tables\Columns\TextColumn::make('events_count')
                    ->label("Eventos que participou")
                    ->badge()
                    ->color(function (int $state) {
                        if ($state > 5) {
                            return "gray";
                        }

                        return "success";
                    })
                    ->counts(['events' => fn (Builder $query): Builder => $query->whereNotNull('checkin_at')]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Data")
                    ->date("d F Y")
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_id')
                    ->label('Papel')
                    ->relationship('role', 'name'),
                Tables\Filters\QueryBuilder::make('events_count')
                    ->constraints([
                        Tables\Filters\QueryBuilder\Constraints\RelationshipConstraint::make('events')
                            ->relationship('events', 'name')->multiple()
                    ])
            ])
            ->filtersFormWidth(MaxWidth::ExtraLarge)
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
