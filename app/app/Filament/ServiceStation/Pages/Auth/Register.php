<?php

namespace App\Filament\ServiceStation\Pages\Auth;

use App\Models\User;
use App\Models\ServiceStation;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Account Information')
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPhoneFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])->columns(2),
                
                Section::make('Service Station Information')
                    ->schema([
                        TextInput::make('station_name')
                            ->label('Service Station Name')
                            ->required()
                            ->maxLength(100),
                        
                        Textarea::make('location')
                            ->label('Address')
                            ->required()
                            ->maxLength(255)
                            ->rows(3),
                        
                        TextInput::make('business_hours')
                            ->label('Business Hours')
                            ->required()
                            ->placeholder('Mon-Fri: 8:00 AM - 6:00 PM')
                            ->maxLength(100),
                        
                        Textarea::make('specializations')
                            ->label('Services Offered')
                            ->required()
                            ->placeholder('Engine repair, Oil change, Brake service, etc.')
                            ->rows(3),
                        
                        TextInput::make('tax_info')
                            ->label('Tax Registration Number')
                            ->required()
                            ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Owner/Manager Name')
            ->required()
            ->maxLength(100)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email Address')
            ->email()
            ->required()
            ->maxLength(100)
            ->unique(User::class);
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label('Contact Number')
            ->tel()
            ->required()
            ->maxLength(20)
            ->placeholder('+94 77 123 4567');
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->minLength(8)
            ->same('passwordConfirmation')
            ->revealable();
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label('Confirm Password')
            ->password()
            ->required()
            ->dehydrated(false)
            ->revealable();
    }

    protected function handleRegistration(array $data): Model
    {
        // Create user account
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'user_type' => User::USER_TYPE_SERVICE_STATION,
            'is_active' => false, // Requires admin approval
        ];
        
        $user = User::create($userData);
        
        // Create service station record
        $stationData = [
            'name' => $data['station_name'],
            'location' => $data['location'],
            'contact' => $data['phone'],
            'business_hours' => $data['business_hours'],
            'specializations' => $data['specializations'],
            'tax_info' => $data['tax_info'],
            'is_verified' => false,
            'rating' => 0,
            'owner_id' => $user->id,
        ];
        
        ServiceStation::create($stationData);
        
        // Assign service station role
        $user->assignRole('service_station');
        
        return $user;
    }
}