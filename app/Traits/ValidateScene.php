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
    protected static function rules($property)
    {
        return static::$$property;
    }

    /**
     * @param string $scene 场景标识
     * @param string $scenes 场景
     * @param string $rules 验证规则
     * @return array|mixed
     * @throws ApiException
     */
    protected function scene( $scene='*', $scenes='scene', $rules='rules' )
    {
        // TODO 获取当前场景的字段信息、获取字段信息下对应的验证规则
        // 默认所有验证规则
        if( $scene == '*' ) return static::rules($rules);
        // 获取当前场景字段信息
        $fields = static::scenes($scenes)[$scene] ?? false;
        //
        if( $fields === false )
            throw new ApiException("Validate Secne: {$scene} Not Found");

        return  Arr::only( static::rules($rules), $fields );
    }

    protected static function achieveRuleWithSecne()
    {

    }

    /**
     * @ 获取所有自定义验证场景
     * @return mixed
     */
    protected static function scenes($property)
    {
        return static::$$property;
    }

}