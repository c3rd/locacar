<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];

    public function rules()
    {
        return [
            'name' => 'required|unique:brands,name,'. $this->id .'',
            'image' => 'required'
        ];
    }

    public function feedbacks()
    {

        return [
            'required' => 'The field :attribute is required',
            'name.unique' => 'The name should be unique',
        ];

    }

}
