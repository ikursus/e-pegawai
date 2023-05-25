<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'tajuk',
        'kandungan',
        'status'
    ];

    public const STATUS_PUBLISHED = 'published';
    public const STATUS_DRAFT = 'draft';

    public static function senaraiStatus ()
    {
        return [
            self::STATUS_DRAFT => self::STATUS_DRAFT,
            self::STATUS_PUBLISHED => self::STATUS_PUBLISHED,
        ];
    }
}
