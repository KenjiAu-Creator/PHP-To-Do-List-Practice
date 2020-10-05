<?php

function Filter($input)
{
  /**
   * Purpose: Applciations with backend functionality require strict security measures to
   *          ensure that the data inside databases are protected. This function will filter
   *          the inputs and return true if the input contains no special characters and false
   *          otherwise.
   * 
   * Author: Kenji Au
   * Date of last edit: Oct. 4, 2020
   * 
   * Args:  $input -> The task the user has inputted in.
   * Returns: Boolean
   */
  
   $pattern = "/[!@#$%^&*()_+.]/";
   if ( preg_match($pattern, $input) == 1)
   {
     return false;
   }
   else
   {
     return true;
   }
}
