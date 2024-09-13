<?php

    function autoVersioning($code, $step) {
        if ($step === "issued") {
            if (is_numeric($code)) {
                // Handle case when code is just a number
                return ($code + 1) + "A";
            } else {
                // Handle case when code contains letters
                $result = "";
                $length = strlen($code);
                for ($i = 0; $i < $length; $i++) {
                    $char = $code[$i];
                    if (ctype_alpha($char)) {
                        $newChar = chr((ord($char) - 65 + 1) % 26 + 65); // Wrap around and increment
                        $result .= $newChar;
                    } else {
                        $result .= $char; // Append non-alphabetic characters as-is
                    }
                }
                return $result;
            }
        } elseif ($step === "approve") {
            // Remove letters and keep numbers
            return preg_replace("/[A-Za-z]/", "", $code);
        } else {
            // Invalid step value
            return "Invalid step";
        }
    }

    function autoVersioning_1($code, $step) {
        if ($step === "issued") {
            if (is_numeric($code)) {
                // Handle case when code is just a number
                return ($code + 1) + "A";
            } else {
                // Handle case when code contains letters
                $result = "";
                $length = strlen($code);
                for ($i = 0; $i < $length; $i++) {
                    $char = $code[$i];
                    if (ctype_alpha($char)) {
                        $newChar = chr((ord($char) - 65 + 1) % 26 + 65); // Wrap around and increment
                        $result .= $newChar;
                    } else {
                        $result .= $char; // Append non-alphabetic characters as-is
                    }
                }
                return $result;
            }
        } elseif ($step === "approve") {
            // Remove letters and keep numbers
            return preg_replace("/[A-Za-z]/", "", $code);
        } else {
            // Invalid step value
            return "Invalid step";
        }
    }
