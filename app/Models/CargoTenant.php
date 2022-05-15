<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class CargoTenant extends Tenant
{
    use HasFactory,UsesLandlordConnection;

    protected $table="tenants";

    protected static function booted()
    {
        static::creating(fn(CargoTenant $model) => $model->createDatabase($model));
    }

    public function createDatabase($model)
    {
        DB::statement('create database '.$model->database);
        Artisan::call('tenants:artisan "migrate --database=tenant --seed" --tenant='.$model->id);
        // Mail::pretend(true);
        // add logic to create database
    }
    /**
     * Get the user that owns the CargoTenant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
