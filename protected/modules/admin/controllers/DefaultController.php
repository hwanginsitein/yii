<?php

class DefaultController extends Controller {
    public $layout = 'column2';
    public function actionIndex() {
        $this->render('index');
    }

}
