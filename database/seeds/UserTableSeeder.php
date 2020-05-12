<?php



    use App\Rules\PositionRule;
    use Carbon\Carbon;
    use Illuminate\Database\Seeder;


class UserTableSeeder  extends Seeder
{

    protected $data_from_people = [];

    protected $start_request = 101000000004;
    protected $last_request;

    protected $count_users_to_db_already = 0;
    protected $count_users_to_db_finish = 1000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->start_request();

       for ($this->count_users_to_db_already; $this->count_users_to_db_already < $this->count_users_to_db_finish;) {
           if (!$this->request_to_people()) continue;
           if (!$this->valid_data()) continue;
           $this->prepare_data_for_db();

           \DB::table('users')->insert( $this->data_from_people[$this->last_request]);

           $this->count_users_to_db_already++;
       }

    }

    private function start_request(){
       $std = \DB::table('users')
                     ->select('email')
                     ->orderBy('email', 'DESC')
                     ->first();
        $email_int = \MainHelper::sanINT($std->email);
        if ($email_int > 101000000000 AND $email_int < 201000000000)
        $this->start_request = $email_int + 1;
    }

    private function request_to_people(){
        if (empty($this->last_request)) $request = $this->start_request;
        else $request = $this->last_request + 1;

        $url = "https://bdsmpeople.club/personal/$request/";
        $html = file_get_contents($url);
        $html = iconv("windows-1251","UTF-8",$html);
        $array = explode("<br>", $html);
        $user = [];
        foreach ($array AS $htmls){
            if (preg_match("!<p class=personal_user_name_vip0>(.*?)</p>!si", $htmls, $matches))
                $user['name'] = $matches[1];
            if (preg_match("!<p class=text_normal_yellow2><i>(.*?)</i></p>!si", $htmls, $matches))
                $user['greeting'] = $matches[1];
            if (preg_match("!<p class=text_info_title>(.*?)</p>!si", $htmls, $matches_info_key)
                AND preg_match("!<p class=text_info_item>(.*?)</p>!si", $htmls, $matches_info_val)
            ){
                $user['info'][$matches_info_key[1]] = $matches_info_val[1];
            }
        }
        $this->last_request = $request;

        if (empty($user)) return false;
        if (empty($user['name'])) return false;
        if (empty($user['greeting'])) return false;
        if (empty($user['info']['Основное'])) return false;
        if (empty($user['info']['О себе'])) return false;
        if (empty($user['info']['Интересы в Теме'])) return false;
        if (empty($user['info']['Табу'])) return false;
        if (empty($user['info']['Позиционирование в Теме'])) return false;

        $this->data_from_people[$request] =  $user;
        return true;
    }

    private function valid_data(){
        $data = $this->data_from_people[$this->last_request];
        $valid = \Validator::make([
            'name' => $data['name'],
            'email' => "bot{$this->last_request}@bdsmzlu.club",
            'greeting' => $data['greeting'],
            'about' => $data['info']['Основное'].'; '.$data['info']['О себе'],
            'interests' => $data['info']['Интересы в Теме'],
            'taboo' => $data['info']['Табу'],
            'position' => $this->refactoring_position($data['info']['Позиционирование в Теме']),
        ],[
            'name' => ['required', 'string', 'min:3', 'max:29'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'greeting' => ['required', 'string', 'min:3', 'max:250'],
            'about' => [ 'min:5','max:3000'],
            'interests' => ['min:5','max:3000'],
            'taboo' => ['min:5','max:3000'],
            'position' => ['required', 'string', new PositionRule, ],
        ]);
        unset($this->data_from_people[$this->last_request]);
        if($valid->fails()) return false;
        $this->data_from_people[$this->last_request] = $valid->validate();
        return true;
    }

    private function prepare_data_for_db(){
        $geo = $this->random_geo();
        $data = $this->data_from_people[$this->last_request];
        $data = $data + $geo;

        $data['password'] = \Hash::make('19901508Oi');
        $data['birthday'] = $this->random_birthday();
        $data['gender'] = $this->gender($data['name']);
        $data['email_verified_at'] = Carbon::now()->toDateTimeString();

        $this->data_from_people[$this->last_request] = $data;
    }

    private function gender($name){

        $women = ['а', 'я', 'a', 'i', 'e', 'u'];
        if ( in_array( mb_substr($name, -1) , $women)  ) return "woman";
        if (random_int(0, 7) == 5) return "trans";
        else return "man";
    }

    private function random_birthday(){
        $year = random_int((date("Y") - 60) ,(date("Y") - 20));
        $month = random_int(1, 12);
        $day = random_int(1, 31);
        return Carbon::create($year, $month, $day)->toDateTimeString();

    }

    private function refactoring_position($position){
        if ($position == 'Доминирование') return 'domination';
        if ($position == 'Подчинение') return 'submission';
        if ($position == 'Свитч') return 'switch';
    }

    private function random_geo(){

        $geo = [
          ['country' => 73, 'region' =>  485, 'city' => 2956], // Mосква
          ['country' => 73, 'region' =>  486, 'city' => 3129], // Санкт-Петербург
          ['country' => 73, 'region' =>  541, 'city' => 5063], // Екатеринбург
          ['country' => 92, 'region' =>  711, 'city' => 10126], // Киев
          ['country' => 8, 'region' =>  48, 'city' => 333], // Минск
        ];

        return $geo[random_int(0, (count($geo) - 1)) ];
    }
}
