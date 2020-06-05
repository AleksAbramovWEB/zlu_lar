<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kassa
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $cash
 * @property float $sum_money
 * @property int $coins
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereSumMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kassa whereUserId($value)
 * @mixin \Eloquent
 */
class Kassa extends Model
{
    protected $table = 'kassa';

    protected $fillable = ['user_id', 'name', 'cash', 'sum_money', 'coins', 'status'];

}
