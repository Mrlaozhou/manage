<?php
namespace App\Traits;

use App\Exceptions\ApiException;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ValidateScene
{

    /**
     * @ 获取所有自定义验证规则
     * @return mixed
     */
    protected static function rules()
    {
        return static::$rules;
    }

    /**
     * @ 获取当前场景下的验证规则
     * @param string $scene
     * @return array
     */
    protected function scene($scene='*')
    {
        // TODO 获取当前场景的字段信息、获取字段信息下对应的验证规则
        // 默认所有验证规则
        if( $scene == '*' ) return static::rules();
        // 获取当前场景字段信息
        $fields = static::scenes()[$scene] ?? false;
        //
        if( $fields === false )
            throw new ApiException("Validate Secne: {$scene} Not Found");

        return  Arr::only( static::rules(), $fields );
    }

    protected static function achieveRuleWithSecne()
    {

    }

    /**
     * @ 获取所有自定义验证场景
     * @return mixed
     */
    protected static function scenes()
    {
        return static::$scene;
    }

}