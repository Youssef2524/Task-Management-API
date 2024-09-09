<?php 
namespace App\Models; 
// use Illuminate\Contracts\Auth\MustVerifyEmail; 
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;  
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Foundation\Auth\User as Authenticatable; 
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject 
{ 
    use HasFactory, Notifiable,SoftDeletes; 
  
    /** 
     * The attributes that are mass assignable. 
     * 
     * @var array<int, string> 
     */ 
   
    protected $guarded = [
        'id',
        'role'
    ];
    protected $dates = ['deleted_at'];

    public $timestamps = true;

const CREATED_AT = 'created_on';
const UPDATED_AT = 'updated_on';

protected $casts = [
    'created_on' => 'datetime',
    'updated_on' => 'datetime',
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
     * Get the attributes that should be cast. 
     * 
     * @return array<string, string> 
     */ 
    protected function casts(): array 
    { 
        return [ 
            'email_verified_at' => 'datetime', 
            'password' => 'hashed', 
        ]; 
    } 
  
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /** 
     * Get the identifier that will be stored in the subject claim of the JWT. 
     * 
     * @return mixed 
     */ 
    public function getJWTIdentifier() 
    { 
        return $this->getKey(); 
    } 
  
    /** 
     * Return a key value array, containing any custom claims to be added to the JWT. 
     * 
     * @return array 
     */ 
    public function getJWTCustomClaims() 
    { 
        return []; 
    } 
}