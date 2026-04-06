<?php

test('toBe funciona', function () {
    expect(10)->toBe(10);
});

test('not com toBe funciona', function () {
    expect(10)->not()->toBe(5);
});

test('toContain funciona', function () {
    expect('Daniel')->toContain('Dan');
});

test('toStartWith funciona', function () {
    expect('Daniel')->toStartWith('Da');
});

test('toEndWith funciona', function () {
    expect('Daniel')->toEndWith('el');
});

test('toHaveCount funciona', function () {
    expect([1,2,3])->toHaveCount(3);
});

test('toHaveKey funciona', function () {
    expect(['a' => 1])->toHaveKey('a');
});

test('toBeGreaterThan funciona', function () {
    expect(10)->toBeGreaterThan(5);
});

test('toBeBetween funciona', function () {
    expect(10)->toBeBetween(5, 15);
});

test('toBeNull funciona', function () {
    expect(null)->toBeNull();
});

test('toBeTrue funciona', function () {
    expect(true)->toBeTrue();
});
