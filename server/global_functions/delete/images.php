<?php
function DeletePhoto($foto)
{
    if(file_exists($foto))
    {
        unlink($foto);

        return true;
    }
    else
    {
        return false;
    }
}