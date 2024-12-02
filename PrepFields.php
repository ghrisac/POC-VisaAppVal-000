<?php

include "Fields.php";

class PrepFields extends Fields
{
    protected $pdf_text = NULL;
    protected $field_config = NULL;
    protected $validated_fields = NULL;
    protected $file_name = "";
    protected $root_dir = "pdf_file/";

    /**
     * Load all dependicies
     * return void
    **/
    protected function _initilize() : void
    {
        include "vendor/autoload.php";
        include "fields_config.php";

        $smalot = new \Smalot\PdfParser\Parser();
        $this->field_config = $fields_with_validation;

        $file = $this->root_dir . ($this->file_name ?? '/text_pdf.pdf');

        $pdf = $smalot->parseFile($file);

        $reader = $pdf->getText();

        $this->pdf_text = preg_split('/\r\n|\r|\n/', $reader);
    }

    /**
     * Prepare fields and call validator
     * return void
    **/
    protected function _prep_fields(string $file_name) : void
    {
        $this->file_name = $file_name;

        $this->_initilize();

        foreach ($this->pdf_text ?? [] as $t)
        {
            foreach ($this->field_config ?? [] as $field)
            {
                if (strtolower(trim($t)) === strtolower(trim($field['text'])))
                {
                    $exploded = explode(' ', preg_replace('/[\s]+/mu', ' ', $field['text']));
                    $fld = $this->_get($exploded, $field['indexes']);
                    
                    if (!$this->_validator($exploded, $fld, $field['boundery'], $field['indexes']))
                    {
                        $this->validated_fields[] = "{$fld}is required!";
                    }
                }
            }
        }
    }
}

?>