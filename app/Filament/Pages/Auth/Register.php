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
                        $this->getRoleFormComponent(),
                       
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

    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->label('Role')
            ->default('user') // Default value is 'user'
            ->options([
                'user' => 'User',
            ])
            ->disabled(); // Make it non-editable so it's fixed to 'user'
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure role is always set to 'user'
        $data['role'] = 'user';

        return $data;
    }

}
