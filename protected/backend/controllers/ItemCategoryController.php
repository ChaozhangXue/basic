<?php

class ItemCategoryController extends MallBaseController {

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Category('create');
        $action = 'category';

        //Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            $parent_node = $_POST['Category']['node'];
            if ($parent_node != 0) {
                $node = Category::model()->findByPk($parent_node);
                $model->appendTo($node);
            }
            // file handling
            $imageUploadFile = CUploadedFile::getInstance($model, 'pic');
            if ($imageUploadFile !== null) { // only do if file is really uploaded
                $imageFileExt = $imageUploadFile->extensionName;

                $save_path = dirname(Yii::app()->basePath) . '/upload/' . $action . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
                $ymd = date("Ymd");
                $save_path .= $ymd . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
                $img_prefix = date("YmdHis") . '_' . rand(10000, 99999);
                $imageFileName = $img_prefix . '.' . $imageFileExt;
                $model->pic = $ymd . '/' . $imageFileName;
                $save_path .= $imageFileName;
            }
            if ($model->saveNode()) {
                if ($imageUploadFile !== null) { // validate to save file
                    $imageUploadFile->saveAs($save_path);
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'update';
        $action = 'category';

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];
            $parent_node = $_POST['Category']['node'];
            if ($parent_node != 0) {
                $node = Category::model()->findByPk($parent_node);
                $parent = $model->parent()->find();
                if ($node->id !== $model->id && $node->id !== $parent->id) {
                    $model->moveAsLast($node);
                }
            } else {
                if (!$model->isRoot()) {
                    $model->moveAsRoot();
                }
            }
            $imageUploadFile = CUploadedFile::getInstance($model, 'pic');
            if ($imageUploadFile !== null) { // only do if file is really uploaded
                $old_image = dirname(Yii::app()->basePath) . '/upload/' . $action . '/' . $model->pic;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
                $imageFileExt = $imageUploadFile->extensionName;

                $save_path = dirname(Yii::app()->basePath) . '/upload/' . $action . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
                $ymd = date("Ymd");
                $save_path .= $ymd . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
                $img_prefix = date("YmdHis") . '_' . rand(10000, 99999);
                $imageFileName = $img_prefix . '.' . $imageFileExt;
                $model->pic = $ymd . '/' . $imageFileName;
                $save_path .= $imageFileName;
            } else {
                $model->pic = $model->pic;
            }

            if ($model->saveNode()) {
                if ($imageUploadFile !== null) { // validate to save file
                    $imageUploadFile->saveAs($save_path);
                }
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $image = dirname(Yii::app()->basePath) . '/upload/category/'. $model->pic;
            if (file_exists($image)) {
                @unlink($image);
            }
            $model->deleteNode();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Category('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Category']))
            $model->attributes = $_GET['Category'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}
