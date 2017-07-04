<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 04.07.17
 * Time: 13:52
 */

namespace borysenko\swagger_parser;

use Yii;
use rest\modules\v1\Module;
use rest\components\api\Controller;

class SwaggerController extends Controller
{
    public $urlJson;

    public function __construct($id, Module $module, array $config = [])
    {
        $this->urlJson = Yii::getAlias('@rest.domain') . '/swagger/main/json';

        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $get = Yii::$app->request->get();

        $content = file_get_contents($this->urlJson);

        $arr = json_decode($content);

        $data = [];
        foreach ($arr->paths as $key => $path) {
            if (!empty($get['url'])) {
                if ($get['url'] != $key) {
                    continue;
                }
            }
            $methods = [];
            if (!empty($path->get)) {
                $methods[] = [
                    'name' => 'get',
                    'attributes' => $path->get->parameters
                ];
            }
            if (!empty($path->post)) {
                $methods[] = [
                    'name' => 'post',
                    'attributes' => $path->post->parameters
                ];
            }
            if (!empty($path->patch)) {
                $methods[] = [
                    'name' => 'patch',
                    'attributes' => $path->patch->parameters
                ];
            }
            if (!empty($path->put)) {
                $methods[] = [
                    'name' => 'put',
                    'attributes' => $path->patch->parameters
                ];
            }
            if (!empty($path->delete)) {
                $methods[] = [
                    'name' => 'delete',
                    'attributes' => $path->delete->parameters
                ];
            }

            foreach ($methods as $method) {
                $data[] = ['url' => $key, 'method' => $method['name'], 'attributes' => $method['attributes']];
            }
        }

        return $data;
    }

    public function actionUrls()
    {
        $content = file_get_contents($this->urlJson);

        $arr = json_decode($content);

        $data = [];
        foreach ($arr->paths as $key => $path) {
            $methods = [];
            if (!empty($path->get)) {
                $methods[] = [
                    'name' => 'get',
                ];
            }
            if (!empty($path->post)) {
                $methods[] = [
                    'name' => 'post',
                ];
            }
            if (!empty($path->put)) {
                $methods[] = [
                    'name' => 'put',
                ];
            }
            if (!empty($path->patch)) {
                $methods[] = [
                    'name' => 'patch',
                ];
            }
            if (!empty($path->delete)) {
                $methods[] = [
                    'name' => 'delete',
                ];
            }

            foreach ($methods as $method) {
                $data[] = ['url' => $key, 'method' => $method['name']];
            }
        }

        return $data;
    }

}