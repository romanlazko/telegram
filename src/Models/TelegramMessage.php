<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramMessage extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function callback_query()
    {
        return $this->hasOne(TelegramCallbackQuery::class, 'message', 'id');
    }

    public function user()
    {
        return $this->belongsTo(TelegramUser::class, 'from', 'id');
    }

    public function chat()
    {
        return $this->belongsTo(TelegramChat::class, 'chat', 'id');
    }

    public function scopeSearch($query, $search)
    {
        $search = strtolower($search);
        return $query->when($search, function($query) use($search) {
            return $query->whereRaw('LOWER(text) LIKE ?', ['%' . $search . '%'])
                ->orWhereRaw('LOWER(caption) LIKE ?', ['%' . $search . '%'])
                ->orWhereRaw('LOWER(reply_markup) LIKE ?', ['%' . $search . '%']);
        });
    }
}
