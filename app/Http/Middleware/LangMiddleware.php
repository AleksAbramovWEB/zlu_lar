<?php

namespace App\Http\Middleware;

use App\Components\LangDetect;
use Closure;

class LangMiddleware
{
    /**
     * @var array поттдерживаемые языки
     */
    protected $languages;

    /**
     * @var string язык по умолчанию
     */
    protected $langDefault;

    /**
     * @var array языки в блазере пользователя
     */
    protected $langUser;


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->languages =  config('app.locales');
        $this->langDefault = config('app.locale');

        $locale = explode('.', $request->getHost())[0] ;

        // при посещении с поддоменом
        if (in_array($locale, $this->languages)){
            \App::setLocale($locale);
            \Session::put('locale', $locale);
        }else {
        // без поддомена
            if (\Session::has('locale')){
                \App::setLocale(\Session::get('locale'));
            }else {
                $locale = $this->userLocal();
                \App::setLocale($locale);
                \Session::put('locale', $locale);
            }
        }


        return $next($request);
    }

    /**
     * вызывается без поддомена
     * получение языка блаузера пользователя
     * в зависимоти от поддержки устанавливает основной или резевный язык блаузера
     * @return string
     */
    private function userLocal(){

            if ($list = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']) : null) {
                if (preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $list, $list))
                    $this->langUser = $list[1];

            } else $this->langUser = [];

            for ($i=0; $i < 4; $i++)
                if (in_array($this->langUser[$i], $this->languages))
                    return $this->langUser[$i];

            return $this->langDefault;
    }


}
