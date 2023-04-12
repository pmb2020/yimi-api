<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class YmInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Ym:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '项目初始化';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dbName = env('DB_DATABASE');

        $this->info('项目开始初始化...');

        if ($this->chmodPlus(storage_path(),0777)) {
            $this->info('storage文件夹修改权限成功！');
        }

        if ($this->chmodPlus(base_path('bootstrap/cache'),0777)) {
            $this->info('bootstrap/cache文件夹修改权限成功！');
        }
        $this->call('key:generate');
        $this->call('jwt:secret');
        $db_res = $this->createDb($dbName);
        if ($db_res != 1) {
            $this->error("$dbName 数据库创建失败：$db_res");
            exit();
        }
        $this->info("$dbName 数据库创建成功！");

        $this->call('migrate:fresh', [
            '--seed' => true
        ]);
        $this->info('项目已经完成初始化！');
        return 0;
    }

    /**
     * 创建数据库
     */
    protected function createDb($db_name)
    {
        $db_host = env('DB_HOST');
        try {
            $conn = new \PDO("mysql:host=$db_host", env('DB_USERNAME'), env('DB_PASSWORD'));
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE $db_name";
            $conn->exec($sql);
            $conn = null;
            return 1;
        } catch (\PDOException $e) {
            return "$db_name 数据库创建失败：" . $e->getMessage();
        }
    }

    /**
     * 递归赋权
     * @param $path
     * @param int $filePerm
     * @param int $dirPerm
     * @return bool
     */
    private function chmodPlus($path, $permission)
    {
        if (!file_exists($path)) {
            return false;
        }
        if (is_file($path)) {
            chmod($path, $permission);
        } elseif (is_dir($path)) {
            $foldersAndFiles = scandir($path);
            $entries = array_slice($foldersAndFiles, 2);
            foreach ($entries as $entry) {
                $this->chmodPlus($path . "/" . $entry, $permission);
            }
            chmod($path, $permission);
        }
        return true;
    }
}
