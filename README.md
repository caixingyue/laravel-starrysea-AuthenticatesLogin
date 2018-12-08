## 安装
- [Laravel](#laravel)
- [Lumen](#lumen)

### Laravel

该软件包可用于 Laravel 5.6 或更高版本。

您可以通过 composer 安装软件包：

``` bash
composer require starrysea/database
```
### Lumen

您可以通过 composer 安装软件包：

``` bash
composer require starrysea/database
```

## 用法

```php
use Starrysea\Database\Expansion;

class User
{
    use Expansion;

    // 通知扩展这是账户模型
    protected $account_model = true;
}
```

```php
use App\Models\User;

class ExpansionGatherTest
{
    public static function unixtime()
    {
        return User::unixtime('intimes')->find(1); // intimes => 2018-11-26 12:25:59
//        return User::unixtime('intimes', '%Y-%m-%d')->find(1); // intimes => 2018-11-26
    }

    public static function isWhere()
    {
        $dataone = '蔡星月';
        $datatwo = '';
        return User::where('id', 1)->isWhere('name', $dataone)->get(); // []
//        return User::where('id', 1)->isWhere('name', '<>', $dataone)->get(); // [User]
//        return User::where('id', 1)->isWhere('name', $datatwo)->get(); // [User]
    }

    public static function isorWhere()
    {
        $dataone = '蔡星月';
        $datatwo = '';
        return User::where('id', 1)->isorWhere('name', $dataone)->get(); // [User]
//        return User::where('id', 1)->isorWhere('name', $datatwo)->get(); // [User]
    }

    public static function isWhereBranchsieve()
    {
        $data = '蔡星月';
        return User::isWhereBranchsieve(
            $data, // content
            'id', // accurate filed
            ['name'] // participle filed
        )->toSql(); // select * from `xh_users` where (`id` = ? or ((`name` like ?) and (`name` like ?)))
    }

    public static function worddivision()
    {
        $data = '蔡星月';
        return User::worddivision($data, function ($query, $words, $data){ // success
            // $words => ['蔡', '星月']
            // $data => '蔡星月'
        }, function ($query, $words, $data){ // error
            // $words => false
            // $data => source
        })->find(1);
    }
}
```
