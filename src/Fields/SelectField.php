<?php


namespace the42coders\TLAP\Fields;


class SelectField extends Field
{
    public $defaultTemplate = 'tlap::forms.select_field';
    public $defaultCol = '12';

    public $options = null;

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
    public function __construct(string $name, string $label = null, bool $dataTable = true, bool $editable = true, string $description = null, string $validation = null, string $defaultValue = null, string $template = null, string $col = null, $options = null)
    {
        parent::__construct($name, $template, $dataTable, $editable, $label, $description, $validation, $col, $defaultValue);

        $this->options = $options;
    }
}
