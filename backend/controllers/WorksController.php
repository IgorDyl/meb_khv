<?php

namespace backend\controllers;

use Yii;
use common\models\Works;
use common\models\WorksSerch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorksController implements the CRUD actions for Works model.
 */
class WorksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Works models.
     * @return mixed
     */
    public function actionsSaveImg()
    {
        $this->enaleCsrfValidation = false;
        if (Yii::$app->request->isPost) {
            $post = ii::$app->request->post();
            $dir = Yii::getAlias('@images').'/'.$post['class'].'/';
            if (!file_exist($dir)) {
                FileHelper::createDirectory($dir);
            }
            $result_link = str_replace ('admin.','',Url::home(true)).'uploads/images/'.$post['class'].'/';
            $file = UploadedFile::getInstanceByName('Images[attachment]');
            $model = new Images();
            $model->file->name=strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $model->file->extension;
            $model->load($post);
            $model->validate();
            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            } else {
                //$model->file->name=strtotime('now').'_'.Yii:$app->getSecurity()->generateRandomString(6) . '.' . $model->file->extension;
                if ($file->saveAs($dir . $model->name)) {
                    $imag = Yii::$app->image->load($dir . $model->name);
                    $imag->resize(800, NULL, Yii\image\drivers\Image::PRECISE)
                        ->save($dir . $model->name, 85);
                    $result = ['filelink' => $result_link . $model->name, 'filename'=>$model->name];
                } else {
                    $result = [
                        'error' => 'ошибка'
                    ];
                }
                $model->save();
            }
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $result;
        } else {
            throw new BadRequestHttpException ('Onli POST is allowed');
        }
    }
    

    public function actionIndex()
    {
        $searchModel = new WorksSerch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Works model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Works model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Works();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Works model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Works model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Works model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Works the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Works::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
