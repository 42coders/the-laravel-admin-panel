<?php


namespace the42coders\TLAP\Fields;


class NumberField extends Field
{

    public $defaultTemplate = 'tlap::forms.number_field';
    public $defaultCol = '12';

    /**
     * NumberField constructor.
     * @param string $name
     * @param string|null $label
     * @param bool $dataTable
     * @param bool $editable
     * @param string|null $description
     * @param string|null $validation
     * @param int|null $defaultValue
     * @param string|null $col
     * @param string|null $template
     */
    public function __construct(string $name, string $label = null, bool $dataTable = false, bool $editable = true, string $description = null, string $validation = null, int $defaultValue = null, string $col = null, string $template = null)
    {
        parent::__construct($name, $template, $dataTable, $editable, $label, $description, $validation, $col, $defaultValue);
    }
}
