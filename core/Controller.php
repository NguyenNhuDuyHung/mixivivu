<?php
class Controller
{
    public function model($model)
    {
        if (file_exists(_DIR_ROOT . '/app/models/' . $model . '.php')) {
            require_once _DIR_ROOT . '/app/models/' . $model . '.php';
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }

        return false;
    }

    public function render($view, $data = [])
    {
        extract($data); // extract data to variable
        $viewPath = _DIR_ROOT . '/app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        }
    }

    function oldInfo($fileName, $oldData, $default = null)
    {
        return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
    }
}
