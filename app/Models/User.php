<?php

namespace App\Models;

use App\Components\MainHelper;
use App\Models\Geo\GeoCities;
use App\Models\Geo\GeoCountries;
use App\Models\Geo\GeoRegions;
use App\Traits\LocalTimestamps;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $country
 * @property int $region
 * @property int $city
 * @property string $birthday
 * @property string $position
 * @property string $gender
 * @property string|null $avatar
 * @property string|null $about
 * @property string|null $interests
 * @property string|null $taboo
 * @property string|null $greeting
 * @property string|null $last_time
 * @property string|null $vip
 * @property int $coins
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGreeting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInterests($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTaboo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereVip($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Geo\GeoCountries $geo_city
 * @property-read \App\Models\Geo\GeoCountries $geo_country
 * @property-read \App\Models\Geo\GeoCountries $geo_region
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 */
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use LocalTimestamps;

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'last_time',
        'deleted_at'
    ];


    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'country', 'region',  'city', 'greeting',
        'birthday', 'position', 'gender' , 'about', 'interests','taboo', 'last_time', 'avatar'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];


    /**
     ********************** СВЯЗИ ***************************************************************************
     */

    /**
     * страна
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geo_country()
    {
        return $this->belongsTo(GeoCountries::class, 'country');
    }

    /**
     * регион
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geo_region()
    {
        return $this->belongsTo(GeoRegions::class, 'region');
    }

    /**
     * город
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function geo_city()
    {
        return $this->belongsTo(GeoCities::class, 'city');
    }


    /**
     ********************** VIEW МЕТОДЫ ********************************************************************
     */

    /**
     * получем возраст по дате рождения
     */
    public function getAge(){
        return Carbon::parse($this->birthday)->diffInYears();
    }


    /**
     * получаем состояние Online пользователя
     * @return string|null
     */
    public function getOnline(){

        return $this->returnTimeFormat(
            $this->last_time_local,
            15, 'online',
            60, __('connexion/profiles.was_for_an_hour'),
            __('connexion/profiles.was')
        );
    }

    /**
     * получаем локализованный массив для профиля
     * @return array
     */
    public function getInfo(){
        $title = "title_".\App::getLocale();
        $array = [
           __('connexion/profiles.country') => $this->geo_country->$title,
           __('connexion/profiles.region') => $this->geo_region->$title,
           __('connexion/profiles.city') => $this->geo_city->$title,
           __('connexion/profiles.gender') => __("connexion/profiles.{$this->gender}"),
           __('connexion/profiles.position') => __("connexion/profiles.{$this->position}"),
        ];
        if (!empty($this->about))
            $array[__("connexion/profiles.about")] = $this->about;
        if (!empty($this->interests))
            $array[__("connexion/profiles.interests")] = $this->interests;
        if (!empty($this->taboo))
            $array[__("connexion/profiles.taboo")] = $this->taboo;

        return $array;
    }

    public function getAvatar(){
//        $genders = ['man', 'woman', 'trans'];
//        $positions = ['domination', 'submission', 'switch'];
//        dd($this->gender, $this->position);

        if ($this->avatar == "" || is_null($this->avatar)) {
            if ($this->gender == "man" && $this->position =="domination")
                return "/img/svg/force/master.svg";
            if ($this->gender == "man" && $this->position =="submission")
                return"/img/svg/force/sabman.svg";
            if ($this->gender == "man" && $this->position =="switch")
                return "/img/svg/force/man.svg";
            if ($this->gender == "woman"&& $this->position =="domination" || $this->gender == "trans" && $this->position =="domination")
                return "/img/svg/force/mistress.svg";
            if ($this->gender == "woman"&& $this->position =="submission" || $this->gender == "trans" && $this->position =="submission")
                return "/img/svg/force/sabwoman.svg";
            if ($this->gender == "woman"&& $this->position =="switch" || $this->gender == "trans" && $this->position =="switch")
                return "/img/svg/force/woman.svg";
        }elseif (is_null($this->gender) && is_null($this->avatar) && is_null($this->position))
            return "/img/svg/force/deleted.svg";
        else{
            return \MainHelper::getFileS3($this->avatar);
        }



    }




}
