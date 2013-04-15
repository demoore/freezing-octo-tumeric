<?php

function cracklibCheck($password, &$message) 
{ 
    // Clean up password 
    $password=str_replace("\r", "", $password); 
    $password=str_replace("\n", "", $password); 

    // Run password through cracklib-check 
    exec("echo ".escapeshellarg($password)." | /usr/sbin/cracklib-check 2>/dev/null", $output, $return_var); 
    
    // Check it ran properly 
    if($return_var==0) 
    { 
        if(preg_match("/^.*\: ([^:]+)$/", $output[0], $matches)) 
        { 
            // Check response 
            if(strtoupper($matches[1])=="OK") 
            { 
                // Password is strong 
                $message="That's one strong password";
                return(true); 
            } 
            else 
            { 
                // Cracklib doesn't like it 
                $message=$matches[1]; 
                return(false); 
            } 
        } 
        else 
        { 
            // Badly formatted response from cracklib-check. 
            throw new Exception("Didn't understand cracklib-check response."); 
        } 
    } 
    else 
    { 
        // Some sort of execution error 
        throw new Exception("Failed to run cracklib-check."); 
    } 
} 
?>
