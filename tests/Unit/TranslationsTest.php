<?php

namespace Tests\Unit;

use Illuminate\Translation\Translator;

class TranslationsTest extends UnitTestCase
{
    private Translator $translator;

    public function setUp(): void
    {
        parent::setUp();
        $this->translator = app()->make(Translator::class);
    }

    public function testIfCanTranslateMessageForGeneralApiError(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'Oops something went wrong',
                'es'
            ),
            'Translation not found'
        );
    }

    public function testIfCanTranslateMessageForEmailSending(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'Your email was sent!',
                'es'
            ),
            'Translation not found'
        );
    }

    public function testIfCanTranslateMessageForMissingCaptchaResponse(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'The captcha response is required',
                'es'
            ),
            'Translation not found'
        );
    }

    public function testIfCanTranslateMessageForWrongPassword(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'Wrong password',
                'es'
            ),
            'Translation not found'
        );
    }

    public function testIfCanTranslateMessageForCourseNotFound(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'Course not found',
                'es'
            ),
            'Translation not found'
        );
    }

    public function testIfCanTranslateMessageForEmailValidation(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'There is already an user with this email',
                'es'
            ),
            'Translation not found'
        );
    }

    public function testIfCanTranslateMessageForEmailSendingResponse(): void
    {
        self::assertTrue(
            $this->translator->hasForLocale(
                'Your email was sent!',
                'es'
            ),
            'Translation not found'
        );
    }

}
