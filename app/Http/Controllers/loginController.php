<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\userModel;
use DB;
class loginController extends Controller
{
    //注册
    public function zhu()
    {
        $data=$_POST;//接收数据
        if ($data==null){
            return  '您进不去';
        }
        if($data['password']!=$data['yespassword']){
            return ['code'=>2,'font'=>'两次密码不一致'];die;
        }
        unset($data['yespassword']);
        $res = userModel::insert($data);

        if($res){
            return ['code'=>1,'font'=>'注册成功'];die;
        }else{
            return ['code'=>2,'font'=>'注册失败'];die;
        }
    }
    //跨越登录
    public function deng()
    {
        $data=$_POST;//接收数据

        if ($data==null){
            return  '您进不去';
        }
        //登录验证
        $users=userModel::where('name',$data['username'])->first();
        if ($users==null){
            return ['code'=>2,'font'=>'用户名或密码错误'];die;
        }
        //转成数组
        $users=$users->toArray();
        if($users['password']!=$data['password']){
            return ['code'=>2,'font'=>'用户名或密码错误'];die;
        }else{
            return ['code'=>1,'font'=>'登录成功'];die;
        }

    }
}