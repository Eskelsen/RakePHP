<?php

// Ok

test('toBe', function () {
    expect(10)->toBe(10);
});

test('not com toBe', function () {
    expect(10)->not()->toBe(5);
});

test('toContain', function () {
    expect('Daniel')->toContain('Dan');
});

test('toStartWith', function () {
    expect('Daniel')->toStartWith('Da');
});

test('toEndWith', function () {
    expect('Daniel')->toEndWith('el');
});

test('toHaveCount', function () {
    expect([1,2,3])->toHaveCount(3);
});

test('toHaveKey', function () {
    expect(['a' => 1])->toHaveKey('a');
});

test('toBeGreaterThan', function () {
    expect(10)->toBeGreaterThan(5);
});

test('toBeBetween', function () {
    expect(10)->toBeBetween(5, 15);
});

test('toBeNull', function () {
    expect(null)->toBeNull();
});

test('toBeTrue', function () {
    expect(true)->toBeTrue();
});

// Falhas

test('toBe', function () {
    expect(5)->toBe(10);
});

test('not com toBe', function () {
    expect(5)->not()->toBe(5);
});

test('toContain', function () {
    expect('coca-cola')->toContain('Dan');
});

test('toStartWith', function () {
    expect('Blumenau')->toStartWith('Da');
});

test('toEndWith', function () {
    expect('Maceió')->toEndWith('el');
});

test('toHaveCount', function () {
    expect([1,2])->toHaveCount(3);
});

test('toHaveKey', function () {
    expect(['b' => 1])->toHaveKey('a');
});

test('toBeGreaterThan', function () {
    expect(2)->toBeGreaterThan(5);
});

test('toBeBetween', function () {
    expect(18)->toBeBetween(5, 15);
});

test('toBeNull', function () {
    expect(false)->toBeNull();
});

test('toBeTrue', function () {
    expect(false)->toBeTrue();
});
