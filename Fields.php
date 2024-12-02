<?php

abstract class Fields
{
    protected $pdf_text = NULL;
    protected $field_config = NULL;

    abstract protected function _initilize();
    abstract protected function _prep_fields(string $file_name);

    protected function _get(array $exploded, array $indexes) : string
    {
        $ret = "";

        foreach ($indexes ?? [] as $index)
        {
            $ret .= $exploded[$index] . " "; 
        }

        return $ret;
    }

    protected function _validator(array $exploded, string $fld, string $boundiry, array $indexes) : bool
    {
        $last_index = (int) $indexes[count($indexes)-1] + 1;
        $last_char = $exploded[$last_index] ?? NULL;

        return !$last_char || $last_char == $boundiry ? FALSE : TRUE;
    }

    public function get_result(string $file_name) : array
    {
        $ret = [];
        $this->_prep_fields($file_name);

        foreach ($this->validated_fields ?? [] as $error)
        {
            $ret[] = $error;
        }

        return $ret;
    }
}

?>