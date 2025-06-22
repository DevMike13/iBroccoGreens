<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Mail;

class Register extends BaseRegister
{
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        
        $data['role'] = 'user';

        return $data;
    }

}
