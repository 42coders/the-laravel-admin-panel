<?php


namespace the42coders\TLAP\Fields;


class PasswordField extends Field
{

    public $defaultTemplate = 'tlap::forms.password_field';
    public $defaultCol = '12';

    public function __construct(string $name, string $label = null, bool $dataTable = false, bool $editable = true, string $description = null, string $validation = null, string $defaultValue = null, string $col = null, string $template = null)
    {
        parent::__construct($name, $template, $dataTable, $editable, $label, $description, $validation, $col, $defaultValue);
    }
}
