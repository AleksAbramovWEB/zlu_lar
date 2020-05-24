<?php

namespace App\Models\Connexion\Messenger;

use App\Traits\LocalTimestamps;
use Carbon\Carbon;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Connexion\Messenger\Messages
 *
 * @property int $id
 * @property int $contact_from
 * @property int $contact_to
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Messages onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages whereContactFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages whereContactTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Messages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Messages withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Messages withoutTrashed()
 * @mixin \Eloquent
 */
class Messages extends Model
{

    use LocalTimestamps;

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'messenger_messages';

    /************************* МОИ МЕТОДЫ ********************************************/

    /**
     * делаем отступ пришедшим сообшениям
     * @param $myContactId integer пользователя кто на сессии
     * @return string
     */
    public function my_indentation($myContactId){
        if($this->contact_from == $myContactId)
            return 'offset-4';
    }

    public function my_name($myContactId, $name){
        if($this->contact_from == $myContactId) return \Auth::user()->name;
        else return $name;
    }



    // отображение времени отпраки сообщения
    public function my_time(){
        return $this->returnTimeFormat(
            $this->created_at_local,
            1, __('connexion/messenger.just'),
            10, __('connexion/messenger.minutes_ago')
        );
    }

    public function my_view($myContactId){
        if($this->contact_from !== $myContactId) return NULL;
        if ($this->viewed == 0) return 'message_is_not_viewed';
        if ($this->viewed == 1) return 'message_is_viewed';
    }








}
