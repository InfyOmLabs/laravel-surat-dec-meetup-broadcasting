<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Visitor
 *
 * @property int $id
 * @property string $session_id
 * @property string $browser
 * @property string $ip
 * @property \Illuminate\Support\Carbon $session_start_time
 * @property \Illuminate\Support\Carbon|null $session_end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereSessionEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereSessionStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Visitor active()
 */
class Visitor extends Model
{
    public $fillable = [
        'session_id',
        'browser',
        'ip',
        'session_start_time',
    ];

    public $dates = [
        'session_start_time',
        'session_end_time'
    ];

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereNull('session_end_time');
    }
}
