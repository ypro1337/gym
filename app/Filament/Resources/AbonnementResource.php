<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbonnementResource\Pages;
use App\Filament\Resources\AbonnementResource\RelationManagers;
use App\Models\Abonnement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbonnementResource extends Resource
{
    protected static ?string $model = Abonnement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')->autofocus()->required(),
                Forms\Components\TextInput::make('tarif')->autofocus()->required()->numeric(),
                Forms\Components\TextInput::make('nbrseances')->autofocus()->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')->sortable(),
                Tables\Columns\TextColumn::make('tarif'),
                Tables\Columns\TextColumn::make('nbrseances'),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListAbonnements::route('/'),
            'create' => Pages\CreateAbonnement::route('/create'),
            'edit' => Pages\EditAbonnement::route('/{record}/edit'),
        ];
    }
}
