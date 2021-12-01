<?php


namespace the42coders\TLAP\Fields;


use Illuminate\Http\Request;

class ImageUploadField extends Field
{
    public $defaultTemplate = 'tlap::forms.image_upload';
    public $defaultCol = '12';

    /**
     * TextField constructor.
     * @param string $name
     * @param string|null $label
     * @param bool $dataTable
     * @param bool $editable
     * @param string|null $description
     * @param string|null $validation
     * @param string|null $defaultValue
     * @param string|null $template
     * @param string|null $col
     */
    public function __construct(string $name, string $label = null, bool $dataTable = true, bool $editable = true, string $description = null, string $validation = null, string $defaultValue = null, string $template = null, string $col = null)
    {
        parent::__construct($name, $template, $dataTable, $editable, $label, $description, $validation, $col, $defaultValue);
    }

    public function postProcessInput($value, Request $request, $model)
    {
        if($request->hasFile($this->name) && $request->file($this->name)->isValid()){
            $model->addMediaFromRequest($this->name)->toMediaCollection($this->name);
        }

        return $value;
    }
}
