<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $fillable = ['first_name','surname','email','address_line1','city','post_code'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
}
