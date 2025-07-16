<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Html;
use Filament\Forms\Components\Modal;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;

class Register extends BaseRegister
{
    public $showingTermsModal = false;

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRoleFormComponent(),
                        Grid::make()
                            
                            ->schema([
                                Checkbox::make('terms_accepted')
                                    ->label('I agree to the')
                                    ->required()
                                    ->extraAttributes([
                                        'class' => 'w-fit',
                                    ])
                                    ->validationAttribute('terms and conditions'),

                                Actions::make([
                                    Action::make('view_terms')
                                        ->label('Terms and Conditions')
                                        ->modalHeading('Terms and Conditions')
                                        ->modalContent(view('components.terms-conditions'))
                                        ->modalSubmitAction(false)
                                        ->link()
                                        ->extraAttributes([
                                            'class' => 'custom-tems-button-input',
                                        ])
                                        ->modalCancelActionLabel('Close'),
                                ])->columnStart(2),
                            ])
                            ->columns(2),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
    
    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->default('user')
            ->hidden(); 
    }

    public function openTermsModal(): void
    {
        $this->showingTermsModal = true;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['terms_accepted']);
        $data['role'] = 'user';

        return $data;
    }

    protected function getViewData(): array
    {
        return [
            'showingTermsModal' => $this->showingTermsModal,
        ];
    }

}
