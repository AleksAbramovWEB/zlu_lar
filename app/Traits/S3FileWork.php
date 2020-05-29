<?php


    namespace App\Traits;


    use Carbon\Carbon;
    use Illuminate\Http\Request;

    /**
     * Trait S3FileWork
     * для работы с файловой системой S3
     *
     * @property $path_s3 мутатор для ссылки временной на S3
     * @package App\Traits
     */
    trait S3FileWork
    {
        /**
         * кладем изображение на s3
         * @param Request $request запрос с файлом
         * @param string  $name имя импута
         * @param string  $path путь для сохранения
         * @return false|string путь и имя файла
         */
        private function S3putImgFile(Request $request, string $name, string $path){
            $path .= "/".Carbon::now()->format('m-Y');
            $address = $request->file($name)->store($path , 's3');
            return $address;
        }

        public function getPathS3Attribute()
        {
            if ($this->path)
                return $this->getPathS3href($this->path);
            else return NULL;

        }



        private function getPathS3href($path){
            $client = \Storage::disk('s3')->getDriver()->getAdapter()->getClient();
            $bucket = \Config::get('filesystems.disks.s3.bucket');
            $command = $client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $path  // file name in s3 bucket which you want to access
            ]);
            $request = $client->createPresignedRequest($command, '+20 minutes');
            return  (string)$request->getUri();
        }

    }
