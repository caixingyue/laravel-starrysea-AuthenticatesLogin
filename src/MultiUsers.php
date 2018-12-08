<?php // 重写应用程序的身份验证用户部分组件

namespace Starrysea\MultiAuth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait MultiUsers
{
    // 重写将用户从应用程序中注销
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return redirect($this->redirectPath());
    }

    // 重写获取失败的登录响应实例
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'account' => $request[$this->username()],
            'message' => [trans('auth.failed')],
        ]);
    }
}