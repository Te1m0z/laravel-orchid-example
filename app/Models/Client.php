<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Client extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'phone',
        'name',
        'last_name',
        'status',
        'email',
        'birthday',
        'service_id',
        'assessment',
        'invoice_id'
    ];

    protected array $allowedSorts = [
        'status'
    ];

    protected array $allowedFilters = [
        'phone'
    ];


    public function setPhoneAttribute($phone)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9+]/', '', $phone);
    }
}
