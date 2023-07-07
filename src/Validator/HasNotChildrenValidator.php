<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Repository\CategoryRepository;

class HasNotChildrenValidator extends ConstraintValidator
{
    function __construct(private CategoryRepository $categoryRepository, private TranslatorInterface $translator) {}

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof HasNotChildren) {
            throw new UnexpectedTypeException($constraint, HasNotChildren::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $category = $this->categoryRepository->findOneByParentId($value);

        if ($category) {
            $this->context->buildViolation($this->translator->trans('validator.has_not_children'))
                ->addViolation();
        }
    }
}