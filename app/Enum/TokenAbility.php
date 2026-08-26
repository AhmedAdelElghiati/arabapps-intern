<?php
namespace App\Enum;

enum TokenAbility:string
{
    case ACCESS_API='access_token';
    case ISSUE_ACCESS_TOKEN='refresh_token';

}