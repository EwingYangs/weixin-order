<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Common;
use app\models\WUser;
use app\models\Order;
use app\models\Menu;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = WUser:: find()->count();
        $orders = Order::find()->where(['order_status' => '0'])->count();
        $money = Order::find()->select('sum(total_price) as money')->where(['order_status' => '1'])->asArray()->one();
        $money = $money['money'];
        $menus = Menu:: find()->count();

        //每天的收入金额和订单数
        $count = 30;
        $order_model = new Order();
        $days_income = $order_model->getDaysIncome($count);
        $days_order = $order_model->getDaysOrder($count);
        $data = array(
                'users' => $users,
                'orders' => $orders,
                'menus' => $menus,
                'money' => $money,
            );
        return $this->render('index',['data' => $data,'days_income' => $days_income,'days_order' => $days_order]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if($post = Yii::$app->request->post()){
            $post['LoginForm']['password'] = md5($post['LoginForm']['password']);
            if ($model->load($post) && $model->login()) {
                $this->redirect(Yii::$app->urlManager->createUrl('site/index'));
            }
        }
        return $this->renderPartial('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->urlManager->createUrl('site/login'));
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
