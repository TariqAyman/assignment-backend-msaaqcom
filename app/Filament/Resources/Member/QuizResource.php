<?php

namespace App\Filament\Resources\Member;

use App\Filament\Resources\Member\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\ActionsPosition;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

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
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('answer')
//                    ->requiresConfirmation()
                    ->label('Answer')
                    ->icon('heroicon-o-pencil')
                    ->color('primary')
                    ->openUrlInNewTab()
//                    ->url(fn (Quiz $quiz): string => route('posts.edit', $record))
//                    ->url(self::getUrl('answer',  [fn (Quiz $quiz): string => $quiz->id]))
                ,
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
            'answer' => Pages\AnswerQuiz::route('/{record}/answer'),
        ];
    }
}
