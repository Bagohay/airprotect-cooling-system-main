<?php

namespace App\Models;
use App\Models\BaseModel;

class AdminModel extends BaseModel{

    protected $table = 'user_account';
    protected $primaryKey = 'ua_id';

    protected $fillable = [
        'ua_profile_url',
        'ua_first_name',
        'ua_last_name',
        'ua_email',
        'ua_hashed_password',
        'ua_phone_number',
        'ua_role_id',
        'ua_is_active',
        'ua_remember_token',
        'ua_remember_token_expires_at',
        'ua_last_login'
    ];

    protected $createdAtColumn = 'ua_created_at';
    protected $updatedAtColumn = 'ua_updated_at';
    protected $deletedAtColumn = 'ua_deleted_at';

    protected $timestamps = true;
    protected $useSoftDeletes = true;

    //usermanagement
    public function getAllUsers() {
        return $this->select('user_account.*, user_role.ur_name AS role_name')
                    ->join('user_role', 'user_account.ua_role_id', 'user_role.ur_id')
                    ->get();
    }


    

}

?>