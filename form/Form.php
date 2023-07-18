<?php

namespace app\form;

use app\core\models\BaseModel;

class Form
{
    public static function begin($action, $method, $options = []): Form
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }

        echo sprintf('<form action="%s" method="%s" %s>', $action, $method, implode(" ", $attributes));

        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(BaseModel $model, $attribute): Field
    {
        return new Field($model, $attribute);
    }
}
