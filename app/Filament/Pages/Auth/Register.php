<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;

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
                        $this->getMobileNumberFormComponent(), 
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                       
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getMobileNumberFormComponent(): Component
    {
        return TextInput::make('mobile_no')
            ->label('Mobile Number')
            ->required()
            ->maxLength(13)
            ->regex('/^\+63[0-9]{10}$/') // This regex ensures the mobile number follows the format
            ->placeholder('e.g., +639123456789')
            ->type('tel'); // Sets the input type to 'tel' for mobile numbers
    }

}
