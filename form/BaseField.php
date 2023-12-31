<?php

namespace app\form;

use app\core\models\BaseModel;

abstract class BaseField
{

    public BaseModel $model;
    public string $attribute;
    public string $type;

    public function __construct(BaseModel $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('<div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }

    abstract public function renderInput(): string;
}
