<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicantResource\Pages;
use App\Models\Applicant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'المتقدمون';

    protected static ?string $modelLabel = 'متقدم';

    protected static ?string $pluralModelLabel = 'المتقدمون';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('البيانات الشخصية')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('الاسم الكامل')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label('رقم الجوال')
                            ->tel()
                            ->required(),
                        Forms\Components\TextInput::make('education')
                            ->label('المؤهل العلمي')
                            ->required(),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('تاريخ الميلاد'),
                        Forms\Components\TextInput::make('city')
                            ->label('المدينة')
                            ->required(),
                    ]),

                Forms\Components\Section::make('بيانات الوظيفة')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('position_applied')
                            ->label('الوظيفة المقدم إليها')
                            ->options([
                                'اخصائي تدريب صحي إعداد العروض' => 'اخصائي تدريب صحي إعداد العروض',
                                'معد عروض فنية'                  => 'معد عروض فنية',
                                'اخصائي تدريب واستشارات'         => 'اخصائي تدريب واستشارات',
                                'مصمم جرافيك ( عروض فنية )'      => 'مصمم جرافيك ( عروض فنية )',
                                'معد عروض تقنية'                 => 'معد عروض تقنية',
                                'مصمم ثري دي'                    => 'مصمم ثري دي',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('current_position')
                            ->label('الوظيفة الحالية')
                            ->required(),
                        Forms\Components\TextInput::make('current_salary')
                            ->label('الراتب الحالي'),
                        Forms\Components\Toggle::make('etimad_knowledge')
                            ->label('معرفة بمنصة اعتماد'),
                        Forms\Components\Select::make('status')
                            ->label('الحالة')
                            ->options([
                                'new'       => 'جديد',
                                'reviewed'  => 'تمت المراجعة',
                                'contacted' => 'تم التواصل',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('experience')
                            ->label('الخبرات السابقة')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('الجوال')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position_applied')
                    ->label('الوظيفة المطلوبة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('المدينة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_salary')
                    ->label('الراتب الحالي')
                    ->searchable(),
                Tables\Columns\IconColumn::make('etimad_knowledge')
                    ->label('اعتماد')
                    ->boolean(),
                Tables\Columns\TextColumn::make('cv_path')
                    ->label('السيرة الذاتية')
                    ->formatStateUsing(fn ($state) => $state ? 'تحميل' : '—')
                    ->url(fn ($record) => $record->cv_path ? asset('storage/' . $record->cv_path) : null)
                    ->openUrlInNewTab()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('portfolio_path')
                    ->label('ملف الأعمال')
                    ->formatStateUsing(fn ($state) => $state ? 'تحميل' : '—')
                    ->url(fn ($record) => $record->portfolio_path ? asset('storage/' . $record->portfolio_path) : null)
                    ->openUrlInNewTab()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'new'       => 'جديد',
                        'reviewed'  => 'تمت المراجعة',
                        'contacted' => 'تم التواصل',
                        default     => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'new'       => 'warning',
                        'reviewed'  => 'primary',
                        'contacted' => 'success',
                        default     => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_qualified')
                    ->label('مؤهل')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                Tables\Columns\IconColumn::make('is_read')
                    ->label('مقروء')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التقديم')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_qualified')
                    ->label('المؤهلون')
                    ->trueLabel('مؤهل فقط')
                    ->falseLabel('غير مؤهل فقط')
                    ->placeholder('الكل'),
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('حالة القراءة')
                    ->trueLabel('مقروء')
                    ->falseLabel('غير مقروء')
                    ->placeholder('الكل'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'new'       => 'جديد',
                        'reviewed'  => 'تمت المراجعة',
                        'contacted' => 'تم التواصل',
                    ]),
                Tables\Filters\SelectFilter::make('position_applied')
                    ->label('الوظيفة')
                    ->options(
                        Applicant::query()
                            ->distinct()
                            ->pluck('position_applied', 'position_applied')
                            ->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_qualified')
                    ->label(fn ($record) => $record->is_qualified ? 'إلغاء التأهيل' : 'تأهيل')
                    ->icon(fn ($record) => $record->is_qualified ? 'heroicon-o-x-circle' : 'heroicon-o-star')
                    ->color(fn ($record) => $record->is_qualified ? 'danger' : 'warning')
                    ->action(fn ($record) => $record->update(['is_qualified' => ! $record->is_qualified])),
                Tables\Actions\Action::make('toggle_read')
                    ->label(fn ($record) => $record->is_read ? 'غير مقروء' : 'تعيين كمقروء')
                    ->icon(fn ($record) => $record->is_read ? 'heroicon-o-envelope' : 'heroicon-o-envelope-open')
                    ->color(fn ($record) => $record->is_read ? 'gray' : 'success')
                    ->action(fn ($record) => $record->update(['is_read' => ! $record->is_read])),
                Tables\Actions\Action::make('mark_reviewed')
                    ->label('تمت المراجعة')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'new')
                    ->action(fn ($record) => $record->update(['status' => 'reviewed']))
                    ->requiresConfirmation()
                    ->modalHeading('تأكيد المراجعة')
                    ->modalDescription('هل تريد تغيير حالة هذا الطلب إلى "تمت المراجعة"؟')
                    ->modalSubmitActionLabel('نعم، تأكيد'),
                Tables\Actions\Action::make('mark_contacted')
                    ->label('تم التواصل')
                    ->icon('heroicon-o-phone')
                    ->color('primary')
                    ->visible(fn ($record) => $record->status === 'reviewed')
                    ->action(fn ($record) => $record->update(['status' => 'contacted']))
                    ->requiresConfirmation()
                    ->modalHeading('تأكيد التواصل')
                    ->modalDescription('هل تريد تغيير حالة هذا الطلب إلى "تم التواصل"؟')
                    ->modalSubmitActionLabel('نعم، تأكيد'),
                Tables\Actions\ViewAction::make()->label('عرض'),
                Tables\Actions\EditAction::make()->label('تعديل'),
                Tables\Actions\DeleteAction::make()->label('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('حذف المحدد'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListApplicants::route('/'),
            'create' => Pages\CreateApplicant::route('/create'),
            'view'   => Pages\ViewApplicant::route('/{record}'),
            'edit'   => Pages\EditApplicant::route('/{record}/edit'),
        ];
    }
}
