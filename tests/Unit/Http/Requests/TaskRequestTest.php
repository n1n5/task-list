<?php

declare(strict_types=1);

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Validator;

describe('TaskRequest', function (): void {

    describe('authorization', function (): void {
        it('authorizes all users', function (): void {
            $request = new TaskRequest();

            expect($request->authorize())->toBeTrue();
        });
    });

    describe('validation rules', function (): void {
        it('has rules for the expected fields', function (): void {
            $request = new TaskRequest();

            expect($request->rules())->toHaveKeys(['title', 'description', 'long_description']);
        });

        it('passes with all valid fields', function (): void {
            $validator = Validator::make(
                [
                    'title' => 'My Task',
                    'description' => 'A short description',
                    'long_description' => 'A longer description with more detail',
                ],
                new TaskRequest()->rules()
            );

            expect($validator->passes())->toBeTrue();
        });
    });

    describe('title validation', function (): void {
        it('requires title', function (): void {
            $validator = Validator::make(
                ['description' => 'desc', 'long_description' => 'long desc'],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('title'))->toBeTrue();
        });

        it('rejects an empty title', function (): void {
            $validator = Validator::make(
                ['title' => '', 'description' => 'desc', 'long_description' => 'long desc'],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('title'))->toBeTrue();
        });

        it('rejects a title exceeding 255 characters', function (): void {
            $validator = Validator::make(
                [
                    'title' => str_repeat('a', 256),
                    'description' => 'desc',
                    'long_description' => 'long desc',
                ],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('title'))->toBeTrue();
        });

        it('accepts a title at exactly 255 characters', function (): void {
            $validator = Validator::make(
                [
                    'title' => str_repeat('a', 255),
                    'description' => 'desc',
                    'long_description' => 'long desc',
                ],
                new TaskRequest()->rules()
            );

            expect($validator->passes())->toBeTrue();
        });
    });

    describe('description validation', function (): void {
        it('requires description', function (): void {
            $validator = Validator::make(
                ['title' => 'My Task', 'long_description' => 'long desc'],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('description'))->toBeTrue();
        });

        it('rejects an empty description', function (): void {
            $validator = Validator::make(
                ['title' => 'My Task', 'description' => '', 'long_description' => 'long desc'],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('description'))->toBeTrue();
        });
    });

    describe('long_description validation', function (): void {
        it('requires long_description', function (): void {
            $validator = Validator::make(
                ['title' => 'My Task', 'description' => 'desc'],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('long_description'))->toBeTrue();
        });

        it('rejects an empty long_description', function (): void {
            $validator = Validator::make(
                ['title' => 'My Task', 'description' => 'desc', 'long_description' => ''],
                new TaskRequest()->rules()
            );

            expect($validator->fails())->toBeTrue()
                ->and($validator->errors()->has('long_description'))->toBeTrue();
        });
    });
});
