<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Status
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_BANNED = 'banned';

    // Role
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    // Dropdown Status
    public static function senaraiStatus()
    {
        return [
            self::STATUS_ACTIVE => ucwords(self::STATUS_ACTIVE),
            self::STATUS_INACTIVE => ucwords(self::STATUS_INACTIVE),
            self::STATUS_BANNED => ucwords(self::STATUS_BANNED),
        ];
    }

    // Dropdown Role
    public static function senaraiRole()
    {
        return [
            self::ROLE_ADMIN => ucwords(self::ROLE_ADMIN),
            self::ROLE_USER => ucwords(self::ROLE_USER),
        ];
    }

    public static function ruleStatus()
    {
        $rules = self::STATUS_ACTIVE;
        $rules .= ',' . self::STATUS_INACTIVE;
        $rules .= ',' . self::STATUS_BANNED;

        return $rules; // active,inactive,banned
    }

    public static function ruleRole()
    {
        $roles = self::ROLE_ADMIN;
        $roles .= ',' . self::ROLE_USER;

        return $roles; // admin,user
    }

    public function isAdmin()
    {
        if (auth()->user()->role == User::ROLE_ADMIN)
        {
            return true;
        }

        return false;
    }

    // Mutator auto encrypt password
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value),
        );
    }
}
