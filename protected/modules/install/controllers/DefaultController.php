<?php

class DefaultController extends Controller
{
    public $layout = '/layouts/column1';

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionStep1()
    {
        $insLockfile = dirname(__FILE__) . '/install_lock.txt';


        if (file_exists($insLockfile)) {
            exit("You had installed");
        }

        $root = dirname(dirname(dirname(dirname(__FILE__))));
        @set_time_limit(0);
        //error_reporting(E_ALL);
        error_reporting(E_ALL || ~E_NOTICE);


        $sp_server = $_SERVER['SERVER_SOFTWARE'];
        $sp_name = $_SERVER['SERVER_NAME'];
        $phpv = phpversion();
        $sp_os = PHP_OS;


        $sp_allow_reference = (ini_get('allow_call_time_pass_reference') ? '<font color=green>[?]On</font>' : '<font color=red>[×]Off</font>');
        $sp_allow_url_fopen = (ini_get('allow_url_fopen') ? '<font color=green>[ok]On</font>' : '<font color=red>[×]Off</font>');
        $sp_safe_mode = (ini_get('safe_mode') ? '<font color=red>[×]On</font>' : '<font color=green>[ok]Off</font>');
        $sp_gd = function_exists("imagecreate");
        $sp_gd = ($sp_gd > 0 ? '<font color=green>[ok]On</font>' : '<font color=red>[×]Off</font>');
        $sp_mysql = (function_exists('mysql_connect') ? '<font color=green>[ok]On</font>' : '<font color=red>[×]Off</font>');

        if ($sp_mysql == '<font color=red>[N]Off</font>'){
            $sp_mysql_err = TRUE;
        }else{
            $sp_mysql_err = FALSE;}
        $sp_testdirs = array(
            '/',
            '/plugin',
            '/config/main.php',
            '/modules/*',
            '/models/*',
            '/user/',

        );


        $this->render('step1', array('sp_name' => $sp_name,
            'sp_os' => $sp_os, 'phpv' => $phpv,
            'sp_server' => $sp_server,
            'sp_os' => $sp_os,
            'sp_allow_url_fopen' => $sp_allow_url_fopen,
            'sp_allow_reference' => $sp_allow_reference,
            'sp_mysql_err' => $sp_mysql_err,
            'sp_testdirs' => $sp_testdirs,
            'sp_mysql' => $sp_mysql,
            'sp_gd' => $sp_gd,
            'root'=>$root,
            'sp_safe_mode' => $sp_safe_mode));


    }

    public function actionStep2()
    {


        $s_lang = 'utf-8';
        if (!empty($_SERVER['REQUEST_URI']))
            $scriptName = $_SERVER['REQUEST_URI'];
        else
            $scriptName = $_SERVER['PHP_SELF'];

        $basepath = preg_replace("#\/install(.*)$#i", '', $scriptName);

        if (!empty($_SERVER['HTTP_HOST']))
            $baseurl = 'http://' . $_SERVER['HTTP_HOST'];
        else
            $baseurl = "http://" . $_SERVER['SERVER_NAME'];


        $rnd_cookieEncode = chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('a'), ord('z'))) . chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('A'), ord('Z'))) . chr(mt_rand(ord('a'), ord('z'))) . mt_rand(1000, 9999) . chr(mt_rand(ord('A'), ord('Z')));
        $isdemosign = 0;

        $model = new ConfigdataForm;


        // collect user input data
        if (isset($_POST['ConfigdataForm'])) {
            $model->attributes = $_POST['ConfigdataForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('step2', array('model' => $model,
            's_lang' => $s_lang,
            'rnd_cookieEncode' => $rnd_cookieEncode,
            'baseurl' => $baseurl,
            'basepath' => $basepath,
            'isdemosign' => $isdemosign,));

    }

    public function actionStep3()
    {
        if (isset($_POST['is-ajax']) && $_POST['is-ajax']) {
            $config = $_POST['config'];
            try {
                $conn = mysql_connect($config['dbhost'], $config['dbuser'], $config['dbpwd']);
            } catch (Exception $e) {
                echo CJSON::encode(array('error' => true, 'msg' => $e->getMessage()));
                return;
            }
            try {
                switch ($_POST['step']) {
                    case '1':
                        mysql_query("CREATE DATABASE IF NOT EXISTS `" . $config['dbname'] . "`;", $conn);
                        mysql_select_db($config['dbname']);
                        $msg = 'create database success...';
                        break;
                    case '2':

                        $msg = 'change config success...';

                        break;

                    case '3':


                        $msg = 'create database table success...';
                        break;
                    case '4':
                        $insLockfile = dirname(__FILE__) . '/install_lock.txt';
                        $fp = fopen($insLockfile, 'w');
                        fwrite($fp, 'You have install ok!');
                        fclose($fp);
                        $msg = 'create config file success...';
                        break;
                }
                echo CJSON::encode(array('error' => false, 'msg' => $msg));
                return;
            } catch (Exception $e) {
                echo CJSON::encode(array('error' => true, 'msg' => $e->getMessage()));
                return;
            }
        } else {
            $this->render('step3', array(
                'config' => $_POST['ConfigdataForm'],
            ));
        }
    }

}