<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['konser_id', 'nama_pemesan', 'email_pemesan','kode','status','kelas_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function konser()
    {
        return $this->belongsTo(Konser::class, 'konser_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
