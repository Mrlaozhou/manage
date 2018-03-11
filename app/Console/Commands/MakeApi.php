<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
class MakeApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api {name?}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $params = $this->argument('name');
        // 重复获取
        if( is_null($params) )
            $params = $this->ask('Please enter apiname') ?: exit('End..');
        if( strpos( $params, '\\' ) !== FALSE )
        {
            $info = explode( '\\', $params );
            $dir = $info[0] ? trim($info[0]) : null;
            $name = ucwords( trim( $info[1] ) );
        }
        else
        {
            $name = ucwords( trim( $params ) );
            $dir = null;
        }
        // exit( "name:{$name},dir:{$dir}" );
        $code = self::do( $name, $dir );
        switch ( $code )
        {
            case 100:
                exit($this->info('Api created successfully.'));
                break;
            case 101:
                exit($this->warn('Api has already exists.'));
                break;
            case 104:
                exit($this->error('Api created failed.'));
                break;
            default:
                exit('Nothing...');
                break;
        }
    }
    private static function do( $name, $dir )
    {
        // 定义目录路径
        $apppath = __DIR__."/../../";           //  ----app/
        $apipath = $apppath.'Api';              //  ----app/Api/
        $dirpath = is_null($dir)
            ?   $apipath
            :   $apipath."/{$dir}";
        // 文件路径
        $filename = $dirpath."/{$name}.php";
        if( self::file()->exists( $filename ) )
            return 101;
        // 目录生成
        is_dir( $apipath )  ?   is_dir( $dirpath ) ?: @mkdir( $dirpath, 0777 )
            :   !@mkdir( $apipath ) ?: @mkdir( $dirpath, 0777 );
        // 父控制器路径
        $parentfilename = $apipath."/Base.php";
        // 判断Controller.php 是否存在
        if( ! self::file()->exists($parentfilename) )
            self::file()->put( $parentfilename, self::getParentContents() );
        // 文件生成
        return ( self::file()->put( $filename, self::getContents( $name, $dir )  ) )
            ?   100
            :   104;
    }
    private static function file()
    {
        return new Filesystem();
    }
    private static function getContents( $name, $dir = null )
    {
        $namespace = $dir===null ? "App\\Api" : "App\\Api\\{$dir}";
        $contents  = <<<STR
<?php
namespace {$namespace};
use Illuminate\Http\Request;
use App\Api\Base;
class {$name} extends Base
{
    public function index( Request \$request )
    {
        //
        
    }
}
STR;
        return $contents;
    }
    private static function getParentContents()
    {
        return <<<STR
<?php
namespace App\Api;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Base extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
STR;
    }
}
