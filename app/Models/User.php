<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Finger;
use App\Models\Phone;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Supplier;
use App\Models\History;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    public $timestamps = FALSE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        // 'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    // LIMIX
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    public static function getListUsers()
    {
        return self::select('name', 'email')->get();
    }

    public static function getListUsersPaginate(int $perPage)
    {
        return self::select('name', 'email')->paginate($perPage);
    }

    public static function getUserById(int $id)
    {
        $user = self::find($id);
        if (!$user) {
            return false;
        }
        return $user;
    }

    public static function createUser(array $data)
    {
        return self::create($data);
    }

    public static function updateUser(int $id, array $data)
    {
        $user = self::find($id);
        if (!$user) {
            return false;
        }
        return $user->update($data);
    }

    public static function deleteUser(int $id)
    {
        $user = self::find($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }


}
