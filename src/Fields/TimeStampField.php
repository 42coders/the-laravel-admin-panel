<?php


namespace the42coders\TLAP\Fields;


use Illuminate\Support\Carbon;

class TimeStampField extends Field
{

    public $defaultTemplate = 'tlap::forms.timestamp_field';
    public $defaultCol = '12';

    /**
     * TimeStampField constructor.
     * @param string $name
     * @param string|null $label
     * @param bool $dataTable
     * @param bool $editable
     * @param string|null $description
     * @param string|null $validation
     * @param Carbon|null $defaultValue
     * @param string|null $col
     * @param string|null $template
     */
    public function __construct(string $name, string $label = null, ?bool $dataTable = true, ?bool $editable = true, string $description = null, string $validation = null, Carbon $defaultValue = null, string $col = null, string $template = null)
    {
        parent::__construct($name, $template, $dataTable, $editable, $label, $description, $validation, $col, $defaultValue);
    }
}
