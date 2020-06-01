<?php


    namespace App\Traits;


    use Carbon\Carbon;

    /**
     * Trait LocalTimestamps
     * служит для отбражения локализованного времени
     * @property $created_at_local локализованный $created_at
     * @property $last_time_local локализованный $last_time
     * @package App\Traits
     */
    trait LocalTimestamps
    {

        private function getLocalTimeZone(){

            if (\Session::has('timezone'))
                 return \Session::get('timezone');
            else return config('app.timezone');
        }


        public function getCreatedAtLocalAttribute()
        {
            if ($this->created_at)
                 return $this->created_at->timezone($this->getLocalTimeZone());
            else return NULL;
        }

        public function getLastTimeLocalAttribute()
        {
            if ($this->last_time)
                 return $this->last_time->timezone($this->getLocalTimeZone());
            else return NULL;
        }


        // отображение времени
        private function returnTimeFormat($timestamp, int $oneTime, string $oneTitle, int $twoTime, string $twoTitle,string $start = '')
        {
            if ($start !== '') $start.= ' ';
            if (is_null($timestamp)) return NULL;

            $carbonNowTimeZone = Carbon::now()->timezone($this->getLocalTimeZone());

            $time = $timestamp->toDateTimeString();
            $data = $timestamp->toDateString();

            $now_date = $carbonNowTimeZone->toDateString();
            $one_minutes_ago = $carbonNowTimeZone->subMinutes($oneTime)->toDateTimeString();
            $ten_minutes_ago = $carbonNowTimeZone->subMinutes($twoTime)->toDateTimeString();
            $day_ago_date = $carbonNowTimeZone->subDay()->toDateString();

            if ($one_minutes_ago < $time)return $oneTitle;
            else if ($ten_minutes_ago < $time)return $twoTitle;
            else {
                if ($data == $day_ago_date) $date = __('connexion/profiles.yesterday');
                else if ($data == $now_date) $date = __('connexion/profiles.today');
                else  $date = $timestamp->format('d.m.Y');
                $at = __('connexion/profiles.at');
                $minutes = $timestamp->format('H:i');
                return "$start$date $at $minutes";
            }
        }

    }
