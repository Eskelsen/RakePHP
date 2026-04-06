# RakePHP 🧪

Menor ferramenta de testes para PHP (Smallest testing tool for PHP).

Simples, leve e sem dependências.

---

## 🚀 Instalação

Clone o repositório:

```bash
git clone https://github.com/Eskelsen/RakePHP.git
```

Ou apenas copie os arquivos para seu projeto.

---

## ▶️ Como usar

### 1. Crie seus testes

Crie arquivos dentro da pasta `tests/`:

```php
<?php

test('2 + 2 = 4', function () {
    expect(2 + 2)->toBe(4);
});
```

---

### 2. Execute

```bash
php run.php
```

---

## ✅ Exemplo de saída

```
✅ toBe funciona
❌ toContain funciona
   Esperado conter 'Dan'

10 passou, 1 falhou
```

---

## 🧩 Assertions disponíveis

```php
expect($value)->toBe($expected);
expect($value)->toEqual($expected);

expect($value)->toBeTrue();
expect($value)->toBeFalse();
expect($value)->toBeNull();
expect($value)->toBeEmpty();

expect($value)->toContain('text');
expect($value)->toStartWith('text');
expect($value)->toEndWith('text');

expect($array)->toHaveCount(3);
expect($array)->toHaveKey('key');

expect($value)->toBeGreaterThan(10);
expect($value)->toBeLessThan(20);
expect($value)->toBeBetween(5, 15);

expect(fn() => ...)->toThrow(Exception::class);
```

---

## 🔁 Negação

```php
expect(10)->not()->toBe(5);
```

---

## 🧰 Compatibilidade

Compatível com PHP 7+.

Inclui polyfills automáticos para funções do PHP 8 (`str_contains`, etc).

---

## 💡 Filosofia

- Sem classes obrigatórias
- Sem boilerplate
- Sem dependências
- Apenas funções simples

---

## 📁 Estrutura

```
RakePHP/
├── run.php
├── src/test.php
├── src/retro-compatibility.php
└── tests/
```

---

## ⚠️ Aviso

Não pretende substituir frameworks completos como PHPUnit ou Pest.
