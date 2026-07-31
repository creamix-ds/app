<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Validacion simple y explicita. Reglas: required, email, min:N, max:N, url.
 * Devuelve mensajes en espanol listos para mostrar.
 */
final class Validator
{
    private array $errors = [];

    public function __construct(private array $data) {}

    public function check(string $field, string $label, string $rules): self
    {
        $value = trim((string) ($this->data[$field] ?? ''));

        foreach (explode('|', $rules) as $rule) {
            [$name, $arg] = array_pad(explode(':', $rule, 2), 2, null);

            if ($name !== 'required' && $value === '') {
                continue; // los campos opcionales vacios no se validan
            }

            $error = match ($name) {
                'required' => $value === '' ? "Falta completar {$label}." : null,
                'email'    => !filter_var($value, FILTER_VALIDATE_EMAIL) ? "El email no parece valido." : null,
                'url'      => !filter_var($value, FILTER_VALIDATE_URL) ? "{$label} debe ser una URL valida." : null,
                'min'      => Str::length($value) < (int) $arg ? "{$label} necesita al menos {$arg} caracteres." : null,
                'max'      => Str::length($value) > (int) $arg ? "{$label} no puede superar {$arg} caracteres." : null,
                default    => null,
            };

            if ($error !== null) {
                // Mayuscula inicial para que el mensaje se lea bien solo.
                $this->errors[$field] = ucfirst($error);
                break;
            }
        }

        return $this;
    }

    public function fails(): bool
    {
        return $this->errors !== [];
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function firstError(): ?string
    {
        return $this->errors === [] ? null : reset($this->errors);
    }
}
