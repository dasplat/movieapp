<?php

namespace App\Filament\Admin\Pages\Auth;

use Filament\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;

class Register extends \Filament\Auth\Pages\Register
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->components([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
}
