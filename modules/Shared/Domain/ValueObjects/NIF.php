<?php

declare(strict_types=1);

namespace Modules\Shared\Domain\ValueObjects;

use InvalidArgumentException;
use Modules\Shared\Domain\Enums\DocumentTypeEnum;

final class NIF
{
    private string $documentNumber;

    private DocumentTypeEnum $documentType;

    public function __construct(string $documentNumber, DocumentTypeEnum $documentType)
    {
        $this->documentNumber = self::normalizeDocumentNumber($documentNumber);
        $this->documentType = $documentType;

        $this->validate();
    }

    public static function create(string $documentNumber): self
    {
        $documentNumber = self::normalizeDocumentNumber($documentNumber);
        $documentType = self::getNIFType($documentNumber);

        return new self($documentNumber, $documentType);
    }

    public static function getNIFType(string $input): DocumentTypeEnum
    {

        if (self::isDNI($input)) {
            return DocumentTypeEnum::DNI;
        }

        if (self::isNIE($input)) {
            return DocumentTypeEnum::NIE;
        }

        if (self::isCIF($input)) {
            return DocumentTypeEnum::CIF;
        }

        return DocumentTypeEnum::PASSPORT;
    }

    /**
     * Checks if the input is a valid DNI or NIE number.
     *
     * This method verifies if the provided input string is a valid DNI or NIE number
     * by checking its format and control digits.
     *
     * @param  string  $input  The document number to check.
     * @return bool `true` if the input is a valid DNI or NIE number, `false` otherwise.
     */
    public static function isValidDniOrNie(string $input): bool
    {
        return self::isDNI($input) || self::isNIE($input);
    }

    public static function isValidNIF(string $input): bool
    {
        if (self::isDNI($input)) {
            return self::isValidDNI($input);
        }

        if (self::isNIE($input)) {
            return self::isValidNIE($input);
        }

        if (self::isCIF($input)) {
            return self::isValidCIF($input);
        }

        return false;
    }

    /**
     * Checks if a DNI number has a valid format and correct control letter.
     *
     * This method normalizes the input document number and performs two checks:
     * 1. Verifies that the DNI number has the correct format using the `isDNI` method.
     * 2. Calculates the control letter and compares it to the control letter provided in the input string.
     *
     * @param  string  $input  The DNI number to validate.
     * @return bool `true` if the DNI has a valid format and the control letter is correct, `false` otherwise.
     */
    public static function isValidDNI(string $input): bool
    {
        $input = self::normalizeDocumentNumber($input);
        $inputArray = mb_str_split($input);

        return self::isDNI($input) && self::getDNIControlDigit($input) === data_get($inputArray, 8);
    }

    public static function autoCreateNif(string $nif, ?DocumentTypeEnum $documentType = null): NIF
    {
        return match (true) {
            NIF::isValidDNI($nif) && $documentType === DocumentTypeEnum::DNI,
            NIF::isValidNIE($nif) && $documentType === DocumentTypeEnum::NIE,
            NIF::isValidCIF($nif) && $documentType === DocumentTypeEnum::CIF,
            $documentType === DocumentTypeEnum::PASSPORT => new NIF($nif, $documentType),
            default => NIF::create($nif),
        };
    }

    /**
     * Checks if a NIE number has a valid format and correct control letter.
     *
     * This method normalizes the input document number and performs two checks:
     * 1. Verifies that the NIE number has the correct format using the `isNIE` method.
     * 2. Calculates the control letter and compares it to the control letter provided in the input string.
     *
     * @param  string  $input  The NIE number to validate.
     * @return bool `true` if the NIE has a valid format and the control letter is correct, `false` otherwise.
     */
    public static function isValidNIE(string $input): bool
    {
        $input = self::normalizeDocumentNumber($input);
        $inputArray = mb_str_split($input);

        return self::isNIE($input) && self::getNIEControlDigit($input) === data_get($inputArray, 8);
    }

    /**
     * Checks if a CIF number has a valid format and correct control digit.
     *
     * This method normalizes the input document number and performs two checks:
     * 1. Verifies that the CIF number has the correct format using the `isCIF` method.
     * 2. Calculates the control digit and compares it to the control digit provided in the input string.
     *
     * @param  string  $input  The CIF number to validate.
     * @return bool `true` if the CIF has a valid format and the control digit is correct, `false` otherwise.
     */
    public static function isValidCIF(string $input): bool
    {
        $input = self::normalizeDocumentNumber($input);
        $inputArray = mb_str_split($input);

        return self::isCIF($input) && self::getCIFControlDigit($input) === data_get($inputArray, 8);
    }

    public static function getNIEControlDigit(string $input): string
    {
        $input = self::normalizeDocumentNumber($input);

        $initialDigit = match ($input[0]) {
            'X' => '0',
            'Y' => '1',
            'Z' => '2',
            default => throw new InvalidArgumentException("Invalid NIE initial letter: {$input[0]}")
        };

        return self::calculateControlDigit($initialDigit.mb_substr($input, 1, 7));
    }

    public static function getDNIControlDigit(string $input): string
    {
        $input = self::normalizeDocumentNumber($input);

        return self::calculateControlDigit(mb_substr($input, 0, 8));
    }

    public static function getCIFControlDigit(string $input): string
    {
        $input = self::normalizeDocumentNumber($input);

        $controlDigit = mb_strtoupper(mb_substr($input, -1));

        $toCheck = mb_str_split(mb_substr($input, 1, 7));

        $summarize = array_sum(array_map(fn ($digit, $index) => $index % 2 ? (int) $digit : array_sum(mb_str_split((string) ((int) $digit * 2))), $toCheck, array_keys($toCheck)));

        $calculatedDigit = 10 - ($summarize % 10);

        if ($calculatedDigit === 10) {
            $calculatedDigit = 0;
        }

        return ctype_alpha($controlDigit) ? self::convertDigitToLetter($calculatedDigit) : (string) $calculatedDigit;
    }

    public static function convertDigitToLetter($digit): string
    {
        $lettersCorresponding = ['J', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        return $lettersCorresponding[$digit] ?? '-';

    }

    /**
     * Checks if a NIE number follows the standard Spanish NIE format.
     *
     * This method normalizes the input document number and then uses a regular expression
     * to verify if the NIE has the correct format: it starts with X, Y, or Z, followed by 7 digits
     * and a control letter.
     *
     * @param  string  $input  The NIE number to check.
     * @return bool `true` if the NIE has the correct format, `false` otherwise.
     */
    public static function isNIE(string $input): bool
    {
        $input = self::normalizeDocumentNumber($input);

        return (bool) preg_match('/^[XYZ]\d{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i', $input);
    }

    /**
     * Checks if a DNI number follows the standard Spanish DNI format.
     *
     * This method normalizes the input document number and then uses a regular expression
     * to verify if the DNI has the correct format: 8 digits followed by a control letter.
     *
     * @param  string  $input  The DNI number to check.
     * @return bool `true` if the DNI has the correct format, `false` otherwise.
     */
    public static function isDNI(string $input): bool
    {
        $input = self::normalizeDocumentNumber($input);

        return (bool) preg_match('/^\d{8}[A-Z]$/i', $input);
    }

    /**
     * Checks if a CIF number follows the standard format of a Spanish CIF.
     *
     * This method normalizes the input document number and then uses a regular expression
     * to verify if the CIF has the correct format: a valid letter followed by 7 digits and a
     * control character (which can be either a number or a letter).
     *
     * @param  string  $input  The CIF number to check.
     * @return bool `true` if the CIF has the correct format, `false` otherwise.
     */
    public static function isCIF(string $input): bool
    {
        $input = self::normalizeDocumentNumber($input);

        return (bool) preg_match('/^[A-HJNPQRSUVW]\d{7}[0-9A-J]$/', $input);
    }

    public function documentNumber(): string
    {
        return $this->documentNumber;
    }

    public function documentType(): string
    {
        return $this->documentType->value;
    }

    public function documentTypeEnum(): DocumentTypeEnum
    {
        return $this->documentType;
    }

    public function equals(NIF $other): bool
    {
        return get_class($this) === get_class($other) && $this->documentNumber === $other->documentNumber && $this->documentType === $other->documentType;
    }

    private static function calculateControlDigit(string $numbers): string
    {
        $rest = (int) $numbers % 23;

        return 'TRWAGMYFPDXBNJZSQVHLCKE'[$rest] ?? '-';
    }

    private static function normalizeDocumentNumber(string $documentNumber): string
    {
        $documentNumber = preg_replace('/[^A-Za-z0-9]/', '', $documentNumber);

        return mb_strtoupper($documentNumber);
    }

    private function validate(): void
    {
        $documentNumber = self::normalizeDocumentNumber($this->documentNumber);
        $documentType = $this->documentType;

        switch ($documentType) {
            case DocumentTypeEnum::DNI:
                if (! $this->isValidDNI($documentNumber)) {
                    throw new InvalidArgumentException('Invalid DNI');
                }
                break;
            case DocumentTypeEnum::NIE:
                if (! $this->isValidNIE($documentNumber)) {
                    throw new InvalidArgumentException('Invalid NIE');
                }
                break;
            case DocumentTypeEnum::CIF:
                if (! $this->isValidCIF($documentNumber)) {
                    throw new InvalidArgumentException('Invalid CIF');
                }
                break;
            case DocumentTypeEnum::PASSPORT:
                break;
            default:
                throw new InvalidArgumentException('Invalid document type');
        }
    }
}
