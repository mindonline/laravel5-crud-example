<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use App\Events\UserCreated;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use FormAccessible;
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $_roles = null;

    protected $fillable = [
        'firstname', 'lastname', 'patname', 'email', 'password', 'birthday',  'city', 'roles'
    ];

    protected $hidden = [
        'password'
    ];

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function getBirthdayAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function formBirthdayAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function setCityAttribute($value)
    {
        $this->city()->associate($value);
    }

    public function setRolesAttribute($value)
    {
        if ($this->id) {
            if (is_array($value) && count($value)) {
                $this->roles()->sync($value);
            } else {
                $this->roles()->sync( [Role::where('name', 'customer')->firstOrFail()->id] );
            }
        } else {
            $this->_roles = $value;
        }
    }



    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    public function save(array $options=[]){

        $result = parent::save($options);

        if ($result && ($this->_roles !== null || !count($this->roles))) {
            $this->roles = $this->_roles;
            $this->_roles = null;
        }

        return $result;
    }


}
