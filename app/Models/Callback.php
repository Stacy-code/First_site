<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Callback
 *
 * @package App\Models
 */
class Callback extends Model
{
    use HasFactory;

    /**
     * Назва таблиці
     *
     * @var string $table
     */
    protected $table = 'callback';

    /**
     * Вимикаємо збереження дати додавання та збереження
     *
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'content', 'confirmed'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

    /**
     * Short content
     *
     * @param int $length
     *
     * @return string
     */
    public function getShortContent(int $length = 50): string
    {
        $content = $this->getAttribute('content');

        return mb_strimwidth($content, 0, $length, '...');
    }
}
