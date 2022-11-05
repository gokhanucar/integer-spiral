<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'layoutId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['x', 'y', 'output'];

    /**
     * Interact with the layout's output matrix.
     *
     * @return Attribute
     */
    protected function output(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
