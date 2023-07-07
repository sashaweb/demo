<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Contracts\Translation\TranslatorInterface;

#[\Attribute]
class HasNotChildren extends Constraint
{
}