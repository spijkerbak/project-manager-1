<?php

class Model {

    /* constructor is used in thee ways:
     * 1. empty, when called with new..()
     * 2. called from fetchObject, 
     *      which copies fields from database record BEFORE construction!
     * 3. explicit with new..($_POST) to copy fields from posted form
     */
    function __construct(?array $form) {
        if (!empty($form)) {
            foreach ($_POST as $key => $value) {
                if(property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

}
