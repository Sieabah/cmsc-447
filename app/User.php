<?php

namespace App;

use App\Classes\Basecamp\BasecampAPI;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'google_id',
        'google_etag', 'google_token', 'display_name', 'gender'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'updated_at', 'created_at',
        'google_etag', 'google_token', 'google_id', 'gender',
        'password', 'remember_token'
    ];

    public function profile(){
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function generateProfile(BasecampAPI $api){
        if($this->profile()->first() == null)
            foreach($api->people() as $person)
                if($person->email_address == $this->email)
                    return Profile::create(['user_id' => $this->id, 'api_id' => $person->id]);

        return false;
    }

    public function organizations(){
        return $this->hasMany(OrganizationUser::class);
    }

    public static function fullUser($id){
        return User::where('id', $id)
            ->with(
                'profile',
                'organizations',
                'organizations.organization',
                'organizations.role',
                'organizations.role.permissions'
            )->first();
    }
}