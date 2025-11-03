<?php
namespace App\Filament\Vendor\Pages\Auth;

use App\Models\User;
use App\Models\PartsVendor;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                
                Section::make('Vendor Information')
                    ->schema([
                        TextInput::make('vendor_name')
                            ->label('Business Name')
                            ->required()
                            ->maxLength(100),
                        
                        Textarea::make('location')
                            ->label('Business Address')
                            ->required()
                            ->maxLength(255)
                            ->rows(3),
                        
                        TextInput::make('business_hours')
                            ->label('Business Hours')
                            ->required()
                            ->placeholder('Mon-Sat: 9:00 AM - 5:00 PM')
                            ->maxLength(100),
                        
                        TextInput::make('tax_info')
                            ->label('Business Registration Number')
                            ->required()
                            ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Contact Person Name')
            ->required()
            ->maxLength(100)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Business Email')
            ->email()
            ->required()
            ->maxLength(100)
            ->unique(User::class);
    }

    protected function getPhoneFormComponent(): Component
    {
        return TextInput::make('phone')
            ->label('Business Phone')
            ->tel()
            ->required()
            ->maxLength(20)
            ->placeholder('+94 11 123 4567');
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
            'user_type' => User::USER_TYPE_VENDOR,
            'is_active' => false, // Requires admin approval
        ];
        
        $user = User::create($userData);
        
        // Create vendor record
        $vendorData = [
            'name' => $data['vendor_name'],
            'location' => $data['location'],
            'contact' => $data['phone'],
            'business_hours' => $data['business_hours'],
            'tax_info' => $data['tax_info'],
            'is_verified' => false,
            'rating' => 0,
            'owner_id' => $user->id,
        ];
        
        PartsVendor::create($vendorData);
        
        // Assign vendor role
        $user->assignRole('vendor');
        
        return $user;
    }
}