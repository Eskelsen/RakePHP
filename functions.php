<?php

$tests = [];

function test($description, $fn) {
    global $tests;
    $tests[] = [$description, $fn];
}

function expect($value) {
    return new class($value) {
        private $value;
        private $negate = false;

        public function __construct($value) {
            $this->value = $value;
        }

        private function check($condition, $message) {
            $result = $this->negate ? !$condition : $condition;

            if (!$result) {
                throw new Exception($message);
            }

            // reseta o not() após uso
            $this->negate = false;

            return $this;
        }

        public function not() {
            $this->negate = true;
            return $this;
        }

        // ===== Igualdade =====

        public function toBe($expected) {
            return $this->check(
                $this->value === $expected,
                "Esperado ser idêntico a " . var_export($expected, true) .
                ", recebido " . var_export($this->value, true)
            );
        }

        public function toEqual($expected) {
            return $this->check(
                $this->value == $expected,
                "Esperado ser igual a " . var_export($expected, true)
            );
        }

        // ===== Boolean / Null =====

        public function toBeTrue() {
            return $this->check($this->value === true, "Esperado true");
        }

        public function toBeFalse() {
            return $this->check($this->value === false, "Esperado false");
        }

        public function toBeNull() {
            return $this->check($this->value === null, "Esperado null");
        }

        public function toBeEmpty() {
            return $this->check(empty($this->value), "Esperado vazio");
        }

        // ===== Strings =====

        public function toContain($needle) {
            return $this->check(
                is_string($this->value) && str_contains($this->value, $needle),
                "Esperado conter '$needle'"
            );
        }

        public function toStartWith($prefix) {
            return $this->check(
                is_string($this->value) && str_starts_with($this->value, $prefix),
                "Esperado começar com '$prefix'"
            );
        }

        public function toEndWith($suffix) {
            return $this->check(
                is_string($this->value) && str_ends_with($this->value, $suffix),
                "Esperado terminar com '$suffix'"
            );
        }

        // ===== Arrays =====

        public function toHaveCount($count) {
            return $this->check(
                is_countable($this->value) && count($this->value) === $count,
                "Esperado ter $count itens"
            );
        }

        public function toHaveKey($key) {
            return $this->check(
                is_array($this->value) && array_key_exists($key, $this->value),
                "Esperado ter a chave '$key'"
            );
        }

        // ===== Comparações =====

        public function toBeGreaterThan($expected) {
            return $this->check(
                $this->value > $expected,
                "Esperado ser maior que $expected"
            );
        }

        public function toBeLessThan($expected) {
            return $this->check(
                $this->value < $expected,
                "Esperado ser menor que $expected"
            );
        }

        public function toBeBetween($min, $max) {
            return $this->check(
                $this->value >= $min && $this->value <= $max,
                "Esperado estar entre $min e $max"
            );
        }

        // ===== Exceções =====

        public function toThrow($exceptionClass = null) {
            if (!is_callable($this->value)) {
                throw new Exception("Valor não é executável (callable)");
            }

            try {
                ($this->value)();
            } catch (Throwable $e) {
                if ($exceptionClass && !($e instanceof $exceptionClass)) {
                    throw new Exception("Lançou exceção diferente de $exceptionClass");
                }

                return $this->check(true, '');
            }

            return $this->check(false, "Esperado lançar exceção");
        }
    };
}
