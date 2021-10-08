<?php


namespace the42coders\TLAP\Fields;


use Illuminate\Database\Eloquent\Model;
use \the42coders\TLAP\Contracts\Fields\Field as FieldContract;

class Field implements FieldContract
{
    public $name;
    public $template;
    public $label;
    public $description;
    public $validation;
    public $col;
    public $defaultValue;
    public $dataTable;
    public $editable;
    public $defaultCol;
    public $defaultTemplate;

    /**
     * Field constructor.
     * @param string $name
     * @param string|null $template
     * @param bool $dataTable
     * @param bool $editable
     * @param string|null $label
     * @param string|null $description
     * @param string|null $validation
     * @param string|null $col
     * @param null $defaultValue
     */
    public function __construct(string $name, ?string $template = null, ?bool $dataTable = true, ?bool $editable = true, ?string $label = null, ?string $description = null, ?string $validation = null, ?string $col = null, $defaultValue = null){
        $this->name = $name;
        $this->template = $template ?? $this->defaultTemplate;
        $this->label = $label;
        $this->description = $description;
        $this->validation = $validation;
        $this->col = $col ?? $this->defaultCol;
        $this->defaultValue = $defaultValue;
        $this->dataTable = $dataTable;
        $this->editable = $editable;
    }

    public function __toString(){
        return $this->name;
    }

    public function getValue(Model $model = null)
    {
        if($model === null){
            return $this->defaultValue;
        }

        $fieldName = $this->name;

        return $model->$fieldName ?? $this->defaultValue;
    }

    public function getInput($value)
    {
        return $value;
    }

    public function render($model = null)
    {
        return view( $this->template, ['field' => $this, 'value' => $this->getValue($model)]);
    }
}
