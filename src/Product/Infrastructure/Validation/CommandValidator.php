<?php 

declare(strict_types=1);

namespace App\Product\Infrastructure\Validation;

use App\Product\Application\Command\CommandValidatorInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommandValidator implements CommandValidatorInterface
{

    public function __construct(
        private readonly ValidatorInterface $validator
    )
    {
    }

    public function validate(object $command, array $context = []) : void 
    {
        $violationsList = $this->validator->validate($command, null, $context);

        if (count($violationsList) > 0) {
           throw new ValidationFailedException($command, $violationsList);
        }
    }
}