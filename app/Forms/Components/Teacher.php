<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class Teacher extends Component
{
    protected string $view = 'forms.components.teacher';

    public static function make(): static
    {
        return app(static::class);
    }
}
