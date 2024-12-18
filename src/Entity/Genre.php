<?php

namespace App\Entity;

enum Genre: string
{
    case novel = 'Novel';
    case crime = 'Crime';
    case fantasy = 'Fantasy';
    case nonfiction = 'Non-fiction';
    case horror = 'Horror';
    case mystery = 'Mystery';
    case fiction = 'Fiction';
    case selfhelp = 'Self-help';
    case classic = 'Classic';


}
