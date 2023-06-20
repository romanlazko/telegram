<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramChat extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(TelegramMessage::class, 'chat', 'id');
    }

    public function bot()
    {
        return $this->belongsTo(Bot::class, 'bot_id', 'id');
    }

    public static function scopeSearch($query, $search)
    {
        $search = strtolower($search);
        return $query->when($search, function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(first_name) LIKE ?', ['%' . $search . '%'])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . $search . '%'])
                    ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $search . '%'])
                    ->orWhereRaw('LOWER(chat_id) LIKE ?', ['%' . $search . '%']);
            });
        });
    }
}
