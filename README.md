# manage 

## php 7 新特性
    标量类型声明
    返回值类型声明
    null合并运算符
    太空船操作符
    通过 define() 定义常量数组
    匿名类
    Unicode codepoint 转译语法
    Closure::call()
    为unserialize()提供过滤
    IntlChar
    预期
    Group use declarations
    Generator delegation
    整数除法函数 intdiv()
    会话选项
    preg_replace_callback_array()
    可以使用 list() 函数来展开实现了 ArrayAccess 接口的对象
    
    
## 核心文件修改备注
### 一、
        file：   Illuminate\Auth\EloquentUserProvider:
        line:   131
        method: validateCredentials
        detail: 
            return $this->hasher->check($plain, $user->getAuthPassword());
            change to
            return $this->createModel()->validateCredentials( $user, $credentials );
       
## logs 
    0316待修复bug:
        1.privilege统一处理
        2.api返还字段修复 error->message
        3.当前用户用权限显示