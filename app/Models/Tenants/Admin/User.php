<?php

namespace App\Models\Tenants\Admin;

use App\Traits\General\Phoneable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;
    use Phoneable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'address',
        'position',
        'medical_id',
        'speciality',
    ];

    protected $with=['phones'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'role'
    ];

    /**
     *  remove all roles of user
     */
    public function removeAllRoles()
    {
        foreach($this->roles as $role) {
            $this->removeRole($role);
        }
    }

    public function removeAllPermissions()
    {
        foreach($this->getAllPermissions() as $permission) {
            $this->revokePermissionTo($permission->name);
        }
    }

    public function getPermissionNames()
    {
        return $this->getAllPermissions()->pluck('name', 'id');
    }

    public function getRole()
    {
        return $this->getRoleNames()->first();
    }

    public function hasPermission($permission)
    {

        return in_array($permission, $this->getPermissionNames()->all());
    }

    public static function receptions()
    {
        return self::role('reception')->get();
    }

    public static function admins()
    {
        return self::role('super-admin')->get();
    }

    function getRoleAttribute(){
        return $this->getRole();
    }

}
