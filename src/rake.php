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

            $this->negate = false;

            return $this;
        }

        public function not() {
            $this->negate = true;
            return $this;
        }

        public function toBe($expected) {
            return $this->check(
                $this->value === $expected,
                "esperado ser idêntico a " . var_export($expected, true) .
                ", recebido " . var_export($this->value, true)
            );
        }

        public function toEqual($expected) {
            return $this->check(
                $this->value == $expected,
                "esperado ser igual a " . var_export($expected, true)
            );
        }

        public function toBeTrue() {
            return $this->check($this->value === true, 'esperado true, recebido ' . var_export($this->value, true));
        }

        public function toBeFalse() {
            return $this->check($this->value === false, 'esperado false, recebido ' . var_export($this->value, true));
        }

        public function toBeNull() {
            return $this->check($this->value === null, 'esperado null, recebido ' . var_export($this->value, true));
        }

        public function toBeEmpty() {
            return $this->check(empty($this->value), 'esperado vazio, recebido ' . var_export($this->value, true));
        }

        public function toContain($needle) {
            return $this->check(
                is_string($this->value) && str_contains($this->value, $needle),
                "esperado conter '$needle', recebido '{$this->value}'"
            );
        }

        public function toStartWith($prefix) {
            return $this->check(
                is_string($this->value) && str_starts_with($this->value, $prefix),
                "esperado começar com '$prefix', recebido '{$this->value}'"
            );
        }

        public function toEndWith($suffix) {
            return $this->check(
                is_string($this->value) && str_ends_with($this->value, $suffix),
                "esperado terminar com '$suffix', recebido '{$this->value}'"
            );
        }

        public function toHaveCount($count) {
            return $this->check(
                is_countable($this->value) && count($this->value) === $count,
                "esperado ter $count itens"
            );
        }

        public function toHaveKey($key) {
            return $this->check(
                is_array($this->value) && array_key_exists($key, $this->value),
                "esperado ter a chave '$key'"
            );
        }

        public function toBeGreaterThan($expected) {
            return $this->check(
                $this->value > $expected,
                "esperado ser maior que '$expected', recebido '{$this->value}'"
            );
        }

        public function toBeLessThan($expected) {
            return $this->check(
                $this->value < $expected,
                "esperado ser menor que '$expected', recebido '{$this->value}'"
            );
        }

        public function toBeBetween($min, $max) {
            return $this->check(
                $this->value >= $min && $this->value <= $max,
                "esperado estar entre $min e $max, recebido '{$this->value}'"
            );
        }

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

            return $this->check(false, "esperado lançar exceção");
        }
    };
}
